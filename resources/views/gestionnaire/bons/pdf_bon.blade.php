@push('scripts')
@if(session('pdf'))
    <script>
        window.onload = function () {
            const link = document.createElement('a');
            link.href = "{{ session('pdf') }}";
            link.download = "";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
@endif
@endpush
