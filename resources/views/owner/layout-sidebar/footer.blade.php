<script src="{{ asset('assets/master/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/master/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/master/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/master/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/master/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/master/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/master/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('assets/master/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/master/js/custom/utilities/modals/new-target.js') }}"></script>
<script src="{{ asset('assets/master/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('assets/master/js/formrepeater.bundle.js')}}"></script>
<script src="{{ asset('assets/owner/js/signin-methods.js')}}"></script>
<script>
    @if(session('toastr_success'))
        toastr.success('{{ session('toastr_success') }}');
    @endif
    @if(session('toastr_error'))
        toastr.error('{{ session('toastr_error') }}');
    @endif
</script>
@yield('script')