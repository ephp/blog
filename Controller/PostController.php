<?php

namespace Ephp\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ephp\BlogBundle\Entity\Post;
use Ephp\BlogBundle\Form\PostType;

/**
 * Post controller.
 *
 * @Route("/blog")
 */
class PostController extends Controller {

    use \Ephp\UtilityBundle\Controller\Traits\BaseController;

    /**
     * Lists all Post entities.
     *
     * @Route("/pag/{pag}", name="blog", defaults={"pag": 1})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($pag) {
        $entities = $this->findBy('EphpBlogBundle:Post', array(), array('createdAt' => 'DESC'), 10, ($pag - 1) * 10);
        $entities_next = $this->findBy('EphpBlogBundle:Post', array(), array('createdAt' => 'DESC'), 1, ($pag) * 10);

        return array(
            'entities' => $entities,
            'pag' => $pag,
            'next' => count($entities_next) == 1,
            'prev' => $pag > 1,
        );
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/", name="blog_create")
     * @Method("POST")
     * @Template("EphpBlogBundle:Post:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Post();
        $form = $this->createForm(new PostType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_index'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @Route("/new", name="blog_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Post();
        $form = $this->createForm(new PostType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="blog_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug) {
        $entity = $this->findOneBy('EphpBlogBundle:Post', array('slug' => $slug));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", name="blog_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $entity = $this->find('EphpBlogBundle:Post', $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createForm(new PostType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Post entity.
     *
     * @Route("/{id}", name="blog_update")
     * @Method("PUT")
     * @Template("EphpBlogBundle:Post:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EphpBlogBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/{id}", name="blog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EphpBlogBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('blog'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
