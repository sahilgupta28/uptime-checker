<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Components\UptimeChecker;
use App\Repositories\Website\WebsiteInterface;
use App\Repositories\TestLog\TestLogInterface;
use App\Http\Requests\Website\SaveRequest;
use App\Http\Requests\Website\StatusRequest;
use Artisan;

class WebsiteController extends Controller
{
    public function __construct(WebsiteInterface $website, TestLogInterface $log)
    {
        $this->website = $website;
        $this->log = $log;
    }

    public function list()
    {
        $websites = $this->website->list();
        return view('dashboard.index', compact('websites'));
    }

    public function save(SaveRequest $request)
    {
        $request->validated();
        $inputs = $request->except('_token');
        $inputs['status'] = (new UptimeChecker())->run($inputs['domain']);
        $inputs['test_at'] = $inputs['status_updated_at'] = date(config('constants.DATE_TIME_FORMAT'));
        $website = $this->website->create($inputs);
        if (!$website->status) {
            $this->website->notify($website->id);
            Artisan::queue('test_log:create', ['data' => $website->only('id', 'status', 'test_at')]);
        }

        return redirect()->back()->with('alert-success', __('New website added successfully'));
    }

    public function update(SaveRequest $request, $id)
    {
        $inputs = $request->validated();
        $this->authorize('owner', $this->website->find($id));
        $this->website->update($id, $inputs);
        return redirect()->back()->with('alert-success', __('Website updated successfully'));
    }

    public function status(StatusRequest $request, $id)
    {
        $inputs = $request->validated();
        $this->authorize('ownerOrAdmin', $this->website->find($id));
        $this->website->update($id, $inputs);
        return redirect()->back()->with('alert-success', __('Website updated successfully'));
    }

    public function destroy($id)
    {
        $this->authorize('owner', $this->website->find($id));
        $this->log->delete($id);
        $this->website->delete($id);
        return redirect()->back()->with('alert-success', __('Website deleted successfully'));
    }

    public function test($id)
    {
        $website = $this->website->find($id);
        $this->authorize('active', $website);
        $new_status = (new UptimeChecker())->run($website->domain);
        $this->website->updateStatus($website->id, $new_status);
        if (!$new_status) {
            $this->website->notify($id);
            Artisan::queue('test_log:create', ['data' => $website->only('id', 'status', 'test_at')]);
        }

        return redirect()->back()->with('alert-success', __('Test run successfully.'));
    }

    public function show(int $id)
    {
        $this->authorize('owner', $this->website->find($id));
        $website = $this->website->find($id);
        $website->slack_hook = $website->slack_hook ? config('constants.SLACK_SLUG') : '';
        return view('website.show', compact('website'));
    }
}
