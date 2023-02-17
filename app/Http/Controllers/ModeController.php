<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModeRequest;
use App\Http\Requests\UpdateModeRequest;
use App\Repositories\ModeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ModeController extends AppBaseController
{
    /** @var ModeRepository $modeRepository*/
    private $modeRepository;

    public function __construct(ModeRepository $modeRepo)
    {
        $this->modeRepository = $modeRepo;
    }

    /**
     * Display a listing of the Mode.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $modes = $this->modeRepository->paginate(10);

        return view('modes.index')
            ->with('modes', $modes);
    }

    /**
     * Show the form for creating a new Mode.
     *
     * @return Response
     */
    public function create()
    {
        return view('modes.create');
    }

    /**
     * Store a newly created Mode in storage.
     *
     * @param CreateModeRequest $request
     *
     * @return Response
     */
    public function store(CreateModeRequest $request)
    {
        $input = $request->all();

        $mode = $this->modeRepository->create($input);

        Flash::success('Mode saved successfully.');

        return redirect(route('modes.index'));
    }

    /**
     * Display the specified Mode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mode = $this->modeRepository->find($id);

        if (empty($mode)) {
            Flash::error('Mode not found');

            return redirect(route('modes.index'));
        }

        return view('modes.show')->with('mode', $mode);
    }

    /**
     * Show the form for editing the specified Mode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mode = $this->modeRepository->find($id);

        if (empty($mode)) {
            Flash::error('Mode not found');

            return redirect(route('modes.index'));
        }

        return view('modes.edit')->with('mode', $mode);
    }

    /**
     * Update the specified Mode in storage.
     *
     * @param int $id
     * @param UpdateModeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModeRequest $request)
    {
        $mode = $this->modeRepository->find($id);

        if (empty($mode)) {
            Flash::error('Mode not found');

            return redirect(route('modes.index'));
        }

        $mode = $this->modeRepository->update($request->all(), $id);

        Flash::success('Mode updated successfully.');

        return redirect(route('modes.index'));
    }

    /**
     * Remove the specified Mode from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mode = $this->modeRepository->find($id);

        if (empty($mode)) {
            Flash::error('Mode not found');

            return redirect(route('modes.index'));
        }

        $this->modeRepository->delete($id);

        Flash::success('Mode deleted successfully.');

        return redirect(route('modes.index'));
    }
}
