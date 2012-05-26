<?php

namespace SL\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use SL\MainBundle\Entity\Test;
use SL\MainBundle\Form\TestType;

/**
 * Test controller.
 *
 */
class TestController extends Controller
{
    /**
     * Lists all Test entities.
     *
     */
    public function indexAction($id_enterprise)
    {
        $this->checkUser($id_enterprise);
        $em = $this->getDoctrine()->getEntityManager();
        $enterprise = $this->getEnterprise($id_enterprise);

        $entities = $em->getRepository('SLMainBundle:Test')->findByEnterprise($id_enterprise);

        return $this->render('SLMainBundle:Test:index.html.twig', array(
            'entities' => $entities,
            'id_enterprise' => $id_enterprise
        ));
    }

    /**
     * Finds and displays a Test entity.
     *
     */
    public function showAction($id, $id_enterprise)
    {
        $this->checkUser($id_enterprise);
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $enterprise = $this->getEnterprise($id_enterprise, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLMainBundle:Test:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'id_enterprise' => $id_enterprise
        ));
    }

    /**
     * Displays a form to create a new Test entity.
     *
     */
    public function newAction($id_enterprise)
    {
        $this->checkUser($id_enterprise);
        $entity = new Test();
        $enterprise = $this->getEnterprise($id_enterprise);

        $form   = $this->createForm(new TestType(), $entity);

        return $this->render('SLMainBundle:Test:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'id_enterprise' => $id_enterprise
        ));
    }

    /**
     * Creates a new Test entity.
     *
     */
    public function createAction($id_enterprise)
    {
        $this->checkUser($id_enterprise);
        $entity  = new Test();
        $request = $this->getRequest();
        $form    = $this->createForm(new TestType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $enterprise = $this->getEnterprise($id_enterprise);
            $entity->setEnterprise($enterprise);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('enterprise_test_show', array(
                'id' => $entity->getId(),
                'id_enterprise' => $id_enterprise
            )));
        }

        return $this->render('SLMainBundle:Test:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'id_enterprise' => $id_enterprise
        ));
    }

    /**
     * Displays a form to edit an existing Test entity.
     *
     */
    public function editAction($id, $id_enterprise)
    {
        $this->checkUser($id_enterprise);
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }
        
        $enterprise = $this->getEnterprise($id_enterprise, $entity);

        $editForm = $this->createForm(new TestType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLMainBundle:Test:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'id_enterprise' => $id_enterprise
        ));
    }

    /**
     * Edits an existing Test entity.
     *
     */
    public function updateAction($id, $id_enterprise)
    {
        $this->checkUser($id_enterprise);
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }
        $enterprise = $this->getEnterprise($id_enterprise, $entity);

        $editForm   = $this->createForm(new TestType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('enterprise_test_edit', array('id' => $id, 'id_enterprise' => $id_enterprise )));
        }

        return $this->render('SLMainBundle:Test:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'id_enterprise' => $id_enterprise
        ));
    }

    /**
     * Deletes a Test entity.
     *
     */
    public function deleteAction($id, $id_enterprise)
    {
        $this->checkUser($id_enterprise);
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SLMainBundle:Test')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Test entity.');
            }
            $this->getEnterprise($id_enterprise, $entity);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('enterprise_test', array('id_enterprise' => $id_enterprise )));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    private function getEnterprise($id, $test = null)
    {
        $enterprise = $this->getDoctrine()->getEntityManager()->getRepository('SLMainBundle:Enterprise')->find($id);
        if ($enterprise == null)
        {
            throw new AccessDeniedException();
        }

        if ($test != null && $test->getEnterprise() !== $enterprise)
        {
            throw new AccessDeniedException();
            //TODO: ajouter un message aux admins !
        }

        return $enterprise;
    }

    public function checkUser($id_enterprise)
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
            return;
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                'SELECT e FROM SLMainBundle:Enterprise e 
                JOIN e.groups wg
                JOIN wg.members u
                WHERE u.id = :id_user AND e.id = :id'
            )->setParameter('id_user', $this->get('security.context')->getToken()->getUser()->getId())
            ->setParameter('id', $id_enterprise);
        if ($query->getOneOrNullResult() == null)
            throw new AccessDeniedException();
    }
}
