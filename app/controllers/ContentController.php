<?php

class ContentController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function showWelcome()
    {
        return View::make('hello');
    }

    public function getMain()
    {
        return View::make('content.main');
    }

    public function getGuides()
    {
        return View::make('content.main-guides');
    }

    public function getContent($title)
    {
        $post_content = null;
        if ($title === 'customer-time-perception') {
            $post_content = '@section("evergreen01")';
        } else if ($title === 'just-in-time') {
            $post_content = '@section("evergreen02")';
        } else if ($title === 'serpentine-queue') {
            $post_content = '@section("evergreen03")';
        } else if ($title === 'what-makes-you-anxious') {
            $post_content = '@section("evergreen04")';
        } else if ($title === 'why-queue-management-important') {
            $post_content = '@section("evergreen05")';
        }

        return View::make('content.evergreen-template')
            ->with('post_content', $post_content);
    }

    public function getHowTo($title)
    {
        $post_content = null;
        if ($title === 'customer-time-perception') {
            $post_content = '@section("evergreen01")';
        } else if ($title === 'just-in-time') {
            $post_content = '@section("evergreen02")';
        } else if ($title === 'serpentine-queue') {
            $post_content = '@section("evergreen03")';
        } else if ($title === 'what-makes-you-anxious') {
            $post_content = '@section("evergreen04")';
        } else if ($title === 'why-queue-management-important') {
            $post_content = '@section("evergreen05")';
        }

        return View::make('content.guides-template')
            ->with('post_content', $post_content);
    }


    public function getCustomerTimePerception()
    {
        return View::make('content.evergreen01');
    }

    public function getJustInTime()
    {
        return View::make('content.evergreen02');
    }

    public function getSerpentineQueue()
    {
        return View::make('content.evergreen03');
    }

    public function getWhatMakesYouAnxious()
    {
        return View::make('content.evergreen04');
    }

    public function getWhyQueueManagementImportant()
    {
        return View::make('content.evergreen05');
    }

    public function getSmallRestaurants()
    {
        return View::make('content.guide-small-restaurants');
    }

    public function getUseQrCode()
    {
        return View::make('content.guide-qr-code');
    }

    public function getCallServeNext()
    {
        return View::make('content.guide-call-serve-next');
    }

}
