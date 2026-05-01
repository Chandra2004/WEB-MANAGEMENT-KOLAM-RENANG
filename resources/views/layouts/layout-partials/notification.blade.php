@if (session('notification'))
    @php
        $notification = session('notification');
        $status = $notification['status'] ?? 'success';

        $styles = [
            'error'   => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'border' => 'border-red-200', 'icon' => 'lucide-x-circle'],
            'success' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'border' => 'border-green-200', 'icon' => 'lucide-check-circle'],
            'warning' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'border' => 'border-yellow-200', 'icon' => 'lucide-alert-circle'],
        ][$status] ?? ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-200', 'icon' => 'lucide-info'];
    @endphp

    <div id="toast-template" class="hidden">
        <div class="toast-item flex items-center w-full max-w-sm p-4 mb-3 text-gray-700 bg-white border {{ $styles['border'] }} rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] transition-all duration-500 ease-[cubic-bezier(0.23,1,0.32,1)] transform scale-90 opacity-0 translate-y-2 select-none"
            role="alert" style="pointer-events: auto;">

            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 {{ $styles['bg'] }} {{ $styles['text'] }} rounded-xl">
                @svg($styles['icon'], "w-6 h-6")
            </div>

            <div class="ms-3 text-sm font-semibold flex-grow">
                {{ $notification['message'] }}
            </div>

            <button type="button" class="ms-4 -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-50 inline-flex items-center justify-center h-8 w-8 btn-close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
        </div>
    </div>

    <script>
        (function() {
            let container = document.getElementById('tf-notifications');
            if (!container) {
                container = document.createElement('div');
                container.id = 'tf-notifications';
                container.className = "fixed top-6 right-6 z-[9999] flex flex-col items-end w-full max-w-xs sm:max-w-sm pointer-events-none";
                document.body.appendChild(container);
            }

            const template = document.querySelector('#toast-template .toast-item');
            const newToast = template.cloneNode(true);
            container.prepend(newToast);
            requestAnimationFrame(() => {
                setTimeout(() => {
                    newToast.classList.remove('scale-90', 'opacity-0', 'translate-y-2');
                    newToast.classList.add('scale-100', 'opacity-100', 'translate-y-0');
                }, 10);
            });

            const removeToast = () => {
                newToast.classList.add('scale-95', 'opacity-0', 'translate-x-10');

                newToast.style.marginBottom = `-${newToast.offsetHeight}px`;
                newToast.style.marginTop = '0px';

                newToast.addEventListener('transitionend', () => {
                    newToast.remove();
                }, { once: true });
            };

            const duration = {{ $notification['duration'] ?? 5000 }};
            let timer = setTimeout(removeToast, duration);

            newToast.querySelector('.btn-close').onclick = () => {
                clearTimeout(timer);
                removeToast();
            };
            newToast.onmouseenter = () => clearTimeout(timer);
            newToast.onmouseleave = () => timer = setTimeout(removeToast, 2000);
        })();
    </script>
@endif
