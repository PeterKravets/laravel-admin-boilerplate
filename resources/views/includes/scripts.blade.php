<script>
    window.translations = {!! Cache::get('translations') !!};
    window.locale = "{{ app()->getLocale() }}";

    window.environment = "{{ app()->environment() }}";

    window.authUserId = {{ auth()->id() ?? 0 }};

</script>
