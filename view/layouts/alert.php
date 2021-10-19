<?php

if ($message = old('alert:success')) {
    include_view('layouts.components.alerts.success', compact('message'));
}

if ($message = old('alert:error')) {
    include_view('layouts.components.alerts.error', compact('message'));
}
