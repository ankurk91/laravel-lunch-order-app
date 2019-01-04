<!-- Footer scripts -->
@stack('before_vendor_scripts')
<script defer src="{{ mix('js/manifest.js') }}"></script>
<script defer src="{{ mix('js/vendor.js') }}"></script>
@stack('after_vendor_scripts')
@stack('before_app_scripts')
<script defer async src="{{ mix('js/app.js') }}"></script>
@stack('after_app_scripts')
