<?php

namespace SL\MainBundle\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use SL\MainBundle\Entity\Enterprise;
use SL\MainBundle\Form\EnterpriseType;

/**
 * Enterprise controller.
 *
 */
class EnterpriseController extends Controller
{
    /**
     * Lists all Enterprise entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            $entities = $em->getRepository('SLMainBundle:Enterprise')->findAll();
        }
        else
        {
            $query = $em->createQuery(
                'SELECT e FROM SLMainBundle:Enterprise e 
                JOIN e.groups wg
                JOIN wg.members u
                WHERE u.id = :id'
            )->setParameter('id', $this->get('security.context')->getToken()->getUser()->getId());
            $entities = $query->getResult();
        }

        return $this->render('SLMainBundle:Enterprise:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Enterprise entity.
     *
     */
    public function showAction($id)
    {
        $this->checkUser();
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:Enterprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enterprise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLMainBundle:Enterprise:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Enterprise entity.
     *@Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new Enterprise();
        $form   = $this->createForm(new EnterpriseType(), $entity);

        return $this->render('SLMainBundle:Enterprise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Enterprise entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction()
    {
        $entity  = new Enterprise();
        $request = $this->getRequest();
        $form    = $this->createForm(new EnterpriseType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('enterprise_show', array('id' => $entity->getId())));
            
        }

        return $this->render('SLMainBundle:Enterprise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Enterprise entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:Enterprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enterprise entity.');
        }

        $editForm = $this->createForm(new EnterpriseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLMainBundle:Enterprise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Enterprise entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:Enterprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enterprise entity.');
        }

        $editForm   = $this->createForm(new EnterpriseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('enterprise_edit', array('id' => $id)));
        }

        return $this->render('SLMainBundle:Enterprise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Enterprise entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SLMainBundle:Enterprise')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Enterprise entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('enterprise'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    public function checkUser()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
            return;
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                'SELECT e FROM SLMainBundle:Enterprise e 
                JOIN e.groups wg
                JOIN wg.members u
                WHERE u.id = :id'
            )->setParameter('id', $this->get('security.context')->getToken()->getUser()->getId());
        if ($query->getOneOrNullResult() == null)
            throw new AccessDeniedException();
    }
}
