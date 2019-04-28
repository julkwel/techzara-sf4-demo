<?php
/**
 * @Author Rajerison Julien <julienrajerison5@gmail.com>
 * @Description Demo Todo Techzara du 27 - 04 - 2019
 */

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use App\Services\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Todo Controller.
 *
 * @Route("/todo")
 */
class TodoController extends AbstractController
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * List Todo Not finished.
     *
     * @Route("/", name="todo_index", methods={"GET","POST"})
     *
     * @param TodoRepository $todoRepository
     *
     * @return Response
     */
    public function index(TodoRepository $todoRepository): Response
    {
        $_user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('todo/index.html.twig', [
            'todos' => $todoRepository->findBy(['todo_is_fin' => 0,'todo_user'=>$_user]),
            'taskfinished' => true,
        ]);
    }

    /**
     * Get all Task finished.
     *
     * @Route("/taskfinished", name="todo_fin_list", methods={"GET","POST"})
     *
     * @param TodoRepository $todoRepository
     *
     * @return Response
     */
    public function taskFinished(TodoRepository $todoRepository): Response
    {
        $_user = $this->get('security.token_storage')->getToken()->getUser();
        $_list_todo_terminer = $todoRepository->findBy(['todo_user'=>$_user,'todo_is_fin'=>1]);

        return $this->render('todo/index.html.twig', [
            'todos' => $_list_todo_terminer,
            'taskfinished' => false,
        ]);
    }

    /**
     * Merge service my.entity.manager to getSubscribedServices.
     *
     * @return array
     */
    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
            'my.entity.manager' => '?'.EntityManager::class,
        ]);
    }

    /**
     * Add new Todo.
     *
     * @Route("/new", name="todo_new", methods={"GET","POST"})
     *
     * @param Request       $request
     * @param EntityManager $entityManager
     *
     * @return Response
     */
    public function new(Request $request, EntityManager $entityManager): Response
    {
        $todo = new Todo();
        $_user = $this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todo->setTodoUser($_user);
            $entityManager->save($todo, 'new');
            $this->addFlash('success', 'Ajout tache éffectué');

            return $this->redirectToRoute('todo_index');
        }

        return $this->render('todo/_form.html.twig', [
            'todo' => $todo,
            'button_id' => 'add',
            'button_text' => 'Add Todo',
            'form' => $form->createView(),
        ]);
    }

    /**
     * Edit todo.
     *
     * @Route("/{id}/edit", name="todo_edit", methods={"GET","POST"})
     *
     * @param Request $request
     * @param Todo    $todo
     *
     * @return Response
     */
    public function edit(Request $request, Todo $todo): Response
    {
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->save($todo, 'update');
            $this->addFlash('success', 'Modification tache éffectué');

            return $this->redirectToRoute('todo_index', [
                'id' => $todo->getId(),
            ]);
        }

        return $this->render('todo/_form.html.twig', [
            'todo' => $todo,
            'button_text' => 'Edit Todo',
            'button_id' => 'edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * Get Todo by status.
     *
     * @param TodoRepository $todoRepository
     * @param $status
     *
     * @return Response
     * @Route("/{status}/status",name="todo_status",methods={"GET","POST"})
     */
    public function getTodoStatus(TodoRepository $todoRepository, $status): Response
    {
        $_user = $this->get('security.token_storage')->getToken()->getUser();
        $todos = $todoRepository->findBy(['todo_status'=>$status,'todo_user'=>$_user]);

        return $this->render('todo/index.html.twig', [
            'todos' => $todos,
            'taskfinished' => true,
        ]);
    }

    /**
     * Finished Todo.
     *
     * @param Todo $todo
     *
     * @return Response
     * @Route("/{id}/fin",name="todo_fin",methods={"GET","POST"})
     */
    public function fin(Todo $todo): Response
    {
        $todo->setTodoIsFin(1);
        $todo->setTodoDateFinExact(new \DateTime('now'));

        $this->em->save($todo, 'update');
        $this->addFlash('success', 'Tache mise terminer');

        return $this->redirectToRoute('todo_index');
    }

    /**
     * Remove todo.
     *
     * @Route("/{id}/delete", name="todo_delete", methods={"POST","GET"})
     *
     * @param Todo $todo
     *
     * @return Response
     */
    public function delete(Todo $todo): Response
    {
        if ($todo) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($todo);
            $entityManager->flush();
            $this->addFlash('success', 'Suppression tache éffectué');
        }

        return $this->redirectToRoute('todo_index');
    }
}
