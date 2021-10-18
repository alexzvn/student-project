<?php

if ($message = old('alert:success')) {
    include_view('layouts.components.success');
}

if ($message = old('alert:error')) {
    include_view('layouts.components.error');
}
