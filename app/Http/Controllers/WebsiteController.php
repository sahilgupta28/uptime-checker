<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Components\UptimeChecker;
use App\Repositories\Website\WebsiteInterface;
use App\Http\Requests\Website\saveRequest;
use Artisan;

class WebsiteController extends Controller
{
    public function __construct(WebsiteInterface $website)
    {
        $this->website = $website;
    }

    public function index()
    {
        $websites = $this->website->list();
        return view('dashboard.index', compact('websites'));
    }

    public function save(saveRequest $request)
    {
        $request->validated();
        $inputs = $request->except('_token');
        $inputs['status'] = (new UptimeChecker())->run($inputs['domain']);
        $inputs['test_at'] = date(config('constants.DATE_TIME_FORMAT'));
        $website = $this->website->create($inputs);
        if (!$website->status) {
            $this->website->notify($website->id);
        }

        Artisan::queue('test_log:create', ['data' => $website->only('id', 'status', 'test_at')]);
        return redirect()->back()->with('alert-success', __('New website added successfully'));
    }

    public function update(saveRequest $request, $id)
    {
        $inputs = $request->validated();
        $this->authorize('updateWebsite', $this->website->find($id));
        $this->website->update($id, $inputs);
        return redirect()->back()->with('alert-success', __('New website added successfully'));
    }

    public function test($id)
    {
        $website = $this->website->find($id);
        $website->test_at = date(config('constants.DATE_TIME_FORMAT'));
        $website->status = (new UptimeChecker())->run($website->domain);
        $this->website->update($website->id, $website->toArray());
        Artisan::queue('test_log:create', ['data' => $website->only('id', 'status', 'test_at')]);
        if (!$website->status) {
            $this->website->notify($id);
        }

        return redirect()->back()->with('alert-success', __('Test run successfully.'));
    }

    public function list()
    {
        $websites = $this->website->all();
        return $this->showSuccessRequest($websites, __('websites list.'), 200);
    }

    public function show(int $id)
    {
        $this->authorize('updateWebsite', $this->website->find($id));
        $website = $this->website->find($id);
        return view('website.show', compact('website'));
    }
}
