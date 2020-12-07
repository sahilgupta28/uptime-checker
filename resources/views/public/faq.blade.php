@extends('layouts.app')
@section('content')
<div class="mx-auto h-full justify-center items-center flex">
    <div class="w-10/12 bg-blue-900 rounded-lg shadow-xl p-6">
        <div class="pb-4">
            <div> What is uptime checker? </div>
            <div class="text-white"> Uptime checker is a powerful tool which checks the uptime of a web project and notifies the user on the project down. </div>
        </div>
        <div class="pb-4">
            <div> How it works? </div>
            <div> You need to create an account with uptime checker. Then you can add your web URL to check their uptime. This tool will ping the URL to check the uptime of the URL. </div>
        </div>
        <div class="pb-4">
            <div> How to register on uptime? </div>
            <div class="text-white">Hit URL:- https://uptime.utool.dev/register Then there are options for register with Uptime.
                <ul class="list-disc pl-4 pt-2">
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elitAdd some user details (Like name, email, password) and create an account.</li>
                    <li>You can directly register with Github.</li>
                </ul>                
            </div>
        </div>
        <div class="pb-4">
            <div>Can we use any social login/register?</div>
            <div class="text-white">Yes, We have integrated Github login/register. So, You can login login/register via Github.</div>
        </div>
        <div class="pb-4">
            <div>What is the frequency of testing ping?</div>
            <div class="text-white">We ping the URL after every 10 min and when it found down then we start pinging every minute until next up.</div>
        </div>
        <div class="pb-4">
            <div>Where user will get notification of down status?</div>
            <div class="text-white">User will get notification of down on Slack. You need to add your slack hook with the web URL.</div>
        </div>
        <div class="pb-4">
            <div>How to add slack hook?</div>
            <div class="text-white">Click on edit domain button, there is an option for add slack hook.</div>
        </div>
        <div class="pb-4">
            <div>What is the slack hook?</div>
            <div class="text-white">Incoming Webhooks are a simple way to post messages from apps into Slack. Creating an Incoming Webhook gives you a unique URL to which you send a JSON payload with the message text and some options.</div>
        </div>
        <div class="pb-4">
            <div>How I can get a slack hook?</div>
            <div class="text-white">Slack provides a service to create webhook. <a class="text-blue-300" href="https://api.slack.com/messaging/webhooks" target="_blank">Click here</a> to know more about it.</div>
        </div>
    </div>
</div>
@endsection