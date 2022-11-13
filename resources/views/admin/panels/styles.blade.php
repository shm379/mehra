<!-- BEGIN: Vendor CSS-->
@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendors-rtl.min.css') }}" />
@else
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendors.min.css') }}" />
@endif

@yield('vendor-style')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset('admin/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/css/base/themes/dark-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/css/base/themes/bordered-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/css/base/themes/semi-dark-layout.css') }}" />

@php $configData = Helper::applyClasses(); @endphp

<!-- BEGIN: Page CSS-->
@if ($configData['mainLayoutType'] === 'horizontal')
  <link rel="stylesheet" href="{{ asset('admin/css/base/core/menu/menu-types/horizontal-menu.css') }}" />
@else
  <link rel="stylesheet" href="{{ asset('admin/css/base/core/menu/menu-types/vertical-menu.css') }}" />
@endif

{{-- Page Styles --}}
@yield('page-style')

<!-- laravel style -->
<link rel="stylesheet" href="{{ asset('admin/css/overrides.css') }}" />

<!-- BEGIN: Custom CSS-->

@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset('admin/css-rtl/custom-rtl.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/css-rtl/style-rtl.css') }}" />

@else
  {{-- user custom styles --}}
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}" />
@endif
