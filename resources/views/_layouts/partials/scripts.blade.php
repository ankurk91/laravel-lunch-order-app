<!-- Footer scripts -->
@stack('before_vendor_scripts')
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
@stack('after_vendor_scripts')
@stack('before_app_scripts')
<script src="{{ mix('js/app.js') }}"></script>
@stack('after_app_scripts')
