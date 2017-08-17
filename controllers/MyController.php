<?php
namespace controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyController extends Controller
{
    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * StartsController constructor.
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function index(Request $request, Response $response)
    {
        return $this->renderer->render($response, 'views/index.phtml', [
            'hello_world' => 'Hello World'
        ]);

    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function ajax(Request $request, Response $response)
    {
        return ["success" => true, "text" => "Hello World"];
    }
}