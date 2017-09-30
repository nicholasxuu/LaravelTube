<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Repositories\CategoryRepository;
use App\Transformers\CategoryTransformer;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
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
     * @var CategoryTransformer
     */
    protected $categoryTransformer;

    /**
     * @var array
     */
    protected $apiMethods = [
        'getAll' => [
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
        'destroy' => [
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
     * @param CategoryTransformer $categoryTransformer
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryTransformer $categoryTransformer
    ) {
        parent::__construct();

        $this->categoryRepository = $categoryRepository;
        $this->categoryTransformer = $categoryTransformer;
    }

    /**
     * Get all Categories
     *
     * @return mixed
     */
    public function getAll()
    {
        $categories = $this->categoryRepository->all();
        return $this->response->withCollection($categories, $this->categoryTransformer);
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

        return $this->response->withItem($category, $this->categoryTransformer);
    }

    /**
     * Delete category
     * @param CategoryDeleteRequest $request
     */
    public function destroy(CategoryDeleteRequest $request)
    {
        $this->categoryRepository->delete($request->input('id'));
    }
}
