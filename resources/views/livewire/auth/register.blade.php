<div class="relative">
    <div class="pointer-events-none absolute inset-0 w-full  pb-64">
        <img style="
                position: absolute;
                width: 700px;
                height: 700px;
                left: 20%;
                top: 200px;
                animation-delay: 1s;
                animation-duration: 4.25s;
            " src="/images/blur.svg" class="animate-pulse-slow" />
        <img style="
                position: absolute;
                width: 700px;
                height: 700px;
                right: 25%;
                top: 120px;
            " src="/images/blur.svg" class="animate-pulse-slow" />
    </div>
    <section class="relative">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-900 dark:border-gray-800">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Crie sua conta
                    </h1>
                    <form class="space-y-4 md:space-y-6" wire:submit="register">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome completo</label>
                            <input type="text" name="name" id="name" wire:model.blur="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Seu nome" required="">
                            @error('name') <span class="text-red-800 font-bold tracking-tight pt-2">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
                            <input type="email" name="email" id="email" wire:model.blur="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="seu@email.com" required="">
                            @error('email') <span class="text-red-800 font-bold tracking-tight mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                            <input type="password" name="password" id="password" wire:model.blur="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @error('password') <span class="text-red-800 font-bold tracking-tight mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirme a senha</label>
                            <input type="password" name="confirm-password" wire:model.blur="password_confirmation" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @error('password_confirmation') <span class="text-red-800 font-bold tracking-tight mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" wire:model="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">Eu concordo com os <a class="font-medium text-blue-600 hover:underline dark:text-blue-500" href="#">Termos e Condições</a></label>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Criar uma conta</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Já tem uma conta? <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Faça o login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>