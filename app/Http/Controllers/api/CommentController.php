<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\CommentDeleteRequest;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Repositories\CommentRepository as Comment;
use App\Transformers\CommentTransformer;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;

/**
 * Class CommentController.
 */
class CommentController extends ApiGuardController
{
    /**
     * @var CommentTransformer
     */
    protected $commentTransformer;

    /**
     * Comment repository.
     *
     * @var Comment
     */
    private $comment;

    /**
     * @var array
     */
    protected $apiMethods = [
        'getComments' => [
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
     * CommentController constructor.
     *
     * @param Comment            $comment
     * @param CommentTransformer $commentTransformer
     */
    public function __construct(Comment $comment, CommentTransformer $commentTransformer)
    {
        parent::__construct();

        $this->commentTransformer = $commentTransformer;
        $this->comment = $comment;
    }

    /**
     * Get comments of video.
     *
     * @param $video_id
     *
     * @return mixed
     */
    public function getComments($video_id)
    {
        $comments = $this->comment->getCommentsVideo($video_id);

        return $this->response->withCollection($comments, $this->commentTransformer);
    }

    /**
     * Store comment.
     *
     * @param CommentStoreRequest $request
     *
     * @return mixed
     */
    public function store(CommentStoreRequest $request)
    {
        $comment = $this->comment->create($request->all());

        return $this->response->withItem($comment, $this->commentTransformer);
    }

    /**
     * Update comment.
     *
     * @param CommentUpdateRequest $request
     *
     * @return mixed
     */
    public function update(CommentUpdateRequest $request)
    {
        $commentId = $request->input('id');
        $user = $request->user();
        if (!$this->checkModPermission($commentId, $user)) {
            return response('Unauthorized.', 401);
        }

        $comment = $this->comment->findOrFail($request->input('id'));

        $this->comment->update($request->all(), $request->input('id'));

        return $this->response->withItem($comment, $this->commentTransformer);
    }

    /**
     * Delete comment.
     *
     * @param CommentDeleteRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(CommentDeleteRequest $request)
    {
        $commentId = $request->input('id');
        $user = $request->user();
        if (!$this->checkModPermission($commentId, $user)) {
            return response('Unauthorized.', 401);
        }

        $this->comment->delete($request->input('id'));
    }

    /**
     * @param $user
     * @param $commentId
     * @return bool
     */
    protected function checkModPermission($user, $commentId)
    {
        $comment = $this->comment->findOrFail($commentId);
        if ($user->level <= 100 && $user->id !== $comment->user_id) {
            return false;
        }
        return true;
    }
}
