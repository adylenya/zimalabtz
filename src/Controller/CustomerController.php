<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Controller for managing customers
 */
#[Route('/customer')]
class CustomerController extends AbstractController
{
    /**
     * Листим всех клиента с пагинацией (?)
     */
    #[Route('/', name: 'app_customer_index', methods: ['GET'])]
    public function index(
        EntityManagerInterface $entityManager,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        // Получаем всех клиентов, сортируя по дате создания
        $query = $entityManager
            ->getRepository(Customer::class)
            ->createQueryBuilder('c')
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery();

        // Создаем пагинацию
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), // Номер текущей страницы
            10 // Количество записей на странице
        );

        return $this->render('customer/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * Создаем клиента
     */
    #[Route('/new', name: 'app_customer_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();

            $this->addFlash('success', 'Клиент успешно создан');
            return $this->redirectToRoute('app_customer_index');
        }

        return $this->render('customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * Показываемм форму клиента
     */
    #[Route('/{id}/edit', name: 'app_customer_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Customer $customer,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Клиент успешно обновлен');
            return $this->redirectToRoute('app_customer_index');
        }

        return $this->render('customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * удаляем клиента
     */
    #[Route('/{id}', name: 'app_customer_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Customer $customer,
        EntityManagerInterface $entityManager
    ): Response {
        // Проверяем CSRF токен для безопасности
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($customer);
            $entityManager->flush();

            $this->addFlash('success', 'Клиент успешно удален');
        }

        return $this->redirectToRoute('app_customer_index');
    }
}