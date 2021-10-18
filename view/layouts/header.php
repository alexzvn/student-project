<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Online</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/custom.css">
</head>

<body>
    <div class="rounded-lg shadow bg-base-200 drawer drawer-end">
    <input id="drawer" type="checkbox" class="drawer-toggle"> 
    <div class="drawer-content">
        <?php include_view('layouts.components.menu') ?>
