<?php

namespace WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\UserRegistrationForm;
use WebBundle\Form\UserFormType;
use UserBundle\Entity\User;

class UserController extends Controller
{
    public function listAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserBundle:User')
            ->findAll();

        return $this->render(
            'users/list.html.twig',
            array('users' => $users)
        );
    }

    public function editAction(Request $request, User $user)
    {
        $form = $this->createForm(UserFormType::class, $user);

        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_list');

        }

        return $this->render(':users:edit.html.twig', [
            'userForm' => $form->createView()
        ]);
    }

    public function deleteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('user_list');

    }

    public function newAction(Request $request)
    {
        $form = $this->createForm(UserFormType::class);

        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $genus = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($genus);
            $em->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render(':users:new.html.twig', [
            'userForm' => $form->createView()
        ]);

    }

    public function registerAction(Request $request)
    {
        $form = $this->createForm(UserRegistrationForm::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Welcome '.$user->getEmail());
            return $this->redirectToRoute('user_homepage');
        }
        return $this->render('users/register.html.twig', [
            'form' => $form->createView()
        ]);
    }



}