<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard: Gestor de Tareas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl text-purple-600 mb-4">Bienvenido al Gestor de Tareas</h1>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-4 my-3"
                        wire:click="openCreateModal">

                        Nuevo
                    </button>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-2/12">
                                        Titulo
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-9/12">
                                        Descripcion
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-1/12">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $task->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $task->description }}
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <button type="button"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                                wire:click="updateTask({{ $task }})">Editar</button>
                                            <button type="button"
                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!------------------Ventana Modal--------------------------->
                        <!-- component -->
                        <@livewire('TaskComponent')
                        @if (isset($modal))
                            <div
                                class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
                                <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                                    <div class="w-full">
                                        <div class="m-8 my-20 max-w-[400px] mx-auto">
                                            <div class="mb-8">
                                                <h1 class="mb-4 text-3xl font-extrabold">Crear nueva Tarea</h1>
                                                <!--Aquí insertamos el formulario--->
                                                <form>
                                                    <div class="mb-4">
                                                        <label for="title"
                                                            class="block mb-2 text-sm font-medium text-gray-900 ">Título</label>
                                                        <input autofocus wire:model="title" type="text"
                                                            id="title" name="title"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Escribe aquí el título de la tarea">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="description"
                                                            class="block mb-2 text-sm font-medium text-gray-900 ">Descripción</label>
                                                        <input wire:model="description" type="text" id="description"
                                                            name="description"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Escribe aquí la descripción de la tarea">

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="space-y-4 flex flex-row">
                                                <button
                                                    class="p-3 bg-black rounded-full text-white w-full font-semibold"
                                                    wire:click.prevent>
                                                    Crear Tarea</button>
                                                <button class="p-3 bg-white border rounded-full w-full font-semibold"
                                                    wire:click='closeCreateModal'>Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <!--fin del modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
