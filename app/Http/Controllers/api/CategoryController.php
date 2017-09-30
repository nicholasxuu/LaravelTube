<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends ApiGuardController
{
    /**
     * Category Repository
     *
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var array
     */
    protected $apiMethods = [
        'getCategories' => [
            'keyAuthentication' => false,
        ],
        'store' => [
            'limits' => [
                'key' => [
                    'increment' => '1 minute',
                    'limit'     => 10,
                ],
            ],
        ],
    ];

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all Categories
     *
     * @return mixed
     */
    public function getCategories()
    {
        $categories = $this->categoryRepository->all();
        return $this->response->withCollection($categories)
    }

    /**
     * Create category
     *
     * @param CategoryStoreRequest $request
     * @return mixed
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryRepository->create($request->all());

        return $this->response->withItem($category);
    }

    /**
     * Delete category
     * @param CategoryDeleteRequest $request
     */
    public function delete(CategoryDeleteRequest $request)
    {
        $this->categoryRepository->delete($request->input('id'));
    }
}
