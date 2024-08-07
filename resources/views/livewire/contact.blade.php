<div class="relative pt-24 ">
    <div class="pointer-events-none absolute inset-0 w-full  pb-64">
        <img style="
                position: absolute;
                width: 700px;
                height: 700px;
                left: 10%;
                top: 400px;
                animation-delay: 1s;
                animation-duration: 4.25s;
            " src="/images/blur.svg" class="animate-pulse-slow" />
        <img style="
                position: absolute;
                width: 700px;
                height: 700px;
                right: 15%;
                top: 120px;
            " src="/images/blur.svg" class="animate-pulse-slow" />

    </div>
    <section class="relative md:h-screen bg-transparent">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Fale conosco</h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Tem alguma dúvida sobre os nossos serviços? Fale conosco.</p>
            <form class="space-y-8" wire:submit="submit">
                @csrf
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nome</label>
                    <input type="text" id="name" name="name" wire:model="name" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Seu nome" required>
                    @error('name') <span class="text-red-800 font-bold tracking-widest mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">E-mail</label>
                    <input type="email" id="email" name="email" wire:model="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="seu@email.com" required>
                    @error('email') <span class="text-red-800 font-bold tracking-widest mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Whatsapp</label>
                    <input type="text" id="phone" name="phone" wire:model="phone" x-mask="(99) 99999 9999" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    @error('phone') <span class="text-red-800 font-bold tracking-widest mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Mensagem</label>
                    <textarea id="message" rows="6" wire:model="message" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deixe sua mensagem..."></textarea>
                    @error('message') <span class="text-red-800 font-bold tracking-widest mt-2">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar mensagem</button>
            </form>
        </div>
    </section>
</div>