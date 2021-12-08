<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePajakAPIRequest;
use App\Http\Requests\API\UpdatePajakAPIRequest;
use App\Models\Pajak;
use App\Repositories\PajakRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PajakController
 * @package App\Http\Controllers\API
 */

class PajakAPIController extends AppBaseController
{
    /** @var  PajakRepository */
    private $pajakRepository;

    public function __construct(PajakRepository $pajakRepo)
    {
        $this->pajakRepository = $pajakRepo;
    }

    /**
     * Display a listing of the Pajak.
     * GET|HEAD /pajaks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pajaks = $this->pajakRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($pajaks->toArray(), 'Pajaks retrieved successfully');
    }

    /**
     * Store a newly created Pajak in storage.
     * POST /pajaks
     *
     * @param CreatePajakAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePajakAPIRequest $request)
    {
        $input = $request->all();

        $pajak = $this->pajakRepository->create($input);

        return $this->sendResponse($pajak->toArray(), 'Pajak saved successfully');
    }

    /**
     * Display the specified Pajak.
     * GET|HEAD /pajaks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pajak $pajak */
        $pajak = $this->pajakRepository->find($id);

        if (empty($pajak)) {
            return $this->sendError('Pajak not found');
        }

        return $this->sendResponse($pajak->toArray(), 'Pajak retrieved successfully');
    }

    /**
     * Update the specified Pajak in storage.
     * PUT/PATCH /pajaks/{id}
     *
     * @param int $id
     * @param UpdatePajakAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePajakAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pajak $pajak */
        $pajak = $this->pajakRepository->find($id);

        if (empty($pajak)) {
            return $this->sendError('Pajak not found');
        }

        $pajak = $this->pajakRepository->update($input, $id);

        return $this->sendResponse($pajak->toArray(), 'Pajak updated successfully');
    }

    /**
     * Remove the specified Pajak from storage.
     * DELETE /pajaks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pajak $pajak */
        $pajak = $this->pajakRepository->find($id);

        if (empty($pajak)) {
            return $this->sendError('Pajak not found');
        }

        $pajak->delete();

        return $this->sendSuccess('Pajak deleted successfully');
    }
}
