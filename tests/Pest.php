<?php

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(function () {
        Http::preventStrayRequests();
    })->in(__DIR__);
