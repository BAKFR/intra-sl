<?php

namespace SL\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use SL\MainBundle\Entity\WorkGroup;
use SL\MainBundle\Form\WorkGroupType;

/**
 * WorkGroup controller.
 *
 */
class WorkGroupController extends Controller
{
    /**
     * Lists all WorkGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SLMainBundle:WorkGroup')->findAll();

        return $this->render('SLMainBundle:WorkGroup:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a WorkGroup entity.
     * 
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:WorkGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLMainBundle:WorkGroup:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new WorkGroup entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new WorkGroup();
        $form   = $this->createForm(new WorkGroupType(), $entity);

        return $this->render('SLMainBundle:WorkGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new WorkGroup entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction()
    {
        $entity  = new WorkGroup();
        $request = $this->getRequest();
        $form    = $this->createForm(new WorkGroupType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('group_show', array('id' => $entity->getId())));
            
        }

        return $this->render('SLMainBundle:WorkGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing WorkGroup entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:WorkGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkGroup entity.');
        }

        $editForm = $this->createForm(new WorkGroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLMainBundle:WorkGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing WorkGroup entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SLMainBundle:WorkGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkGroup entity.');
        }

        $editForm   = $this->createForm(new WorkGroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('group_edit', array('id' => $id)));
        }

        return $this->render('SLMainBundle:WorkGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a WorkGroup entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SLMainBundle:WorkGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WorkGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('group'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
