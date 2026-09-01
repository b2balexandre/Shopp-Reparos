<footer class="footer-custom">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos os direitos reservados.
    </div>
</footer>

@push('styles')
<style>
.footer-custom {
    background: #1e3a8a !important;
    color: #fff !important;
    width: 100%;
    left: 0;
    bottom: 0;
    position: relative;
    z-index: 10;
}
.footer-custom * {
    color: #fff !important;
}
</style>
@endpush
