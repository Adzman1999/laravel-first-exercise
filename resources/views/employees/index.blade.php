<x-layout>
    @auth
        <div class="container" style="margin-top: 5rem">
            <div class="mb-4 ml-1.5 mt-4 flex flex-row-reverse">
                <a href="/employees/create" class="bg-gray-900 rounded text-white py-2 px-5"><i class="fa-solid fa-plus"></i>
                    Create new employee</a>
            </div>

            <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4 lg:ml-12">

                @unless (count($employees) == 0)
                    @foreach ($employees as $employee)
                        <x-card>
                            <div class="flex flex-col">
                                <div class="flex items-center flex-row gap-2">
                                    <h3 class="text-2xl font-bold">
                                        <p style="text-transform: uppercase">
                                            {{ $employee->first_name }}</p>
                                    </h3>

                                    <h3 class="text-2xl font-bold">
                                        <p style="text-transform: uppercase">
                                            {{ $employee->last_name }}</p>
                                    </h3>
                                </div>

                                <hr />
                                <div class="text-lg mb-2mt-2">
                                    <div>
                                        <i class="fa-solid fa-envelope"></i> {{ $employee->email }}
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-phone"></i> {{ $employee->phone }}
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-building"></i> {{ $employee->companies->name }}
                                    </div>
                                    <div class="flex lg:flex-row-reverse">
                                        <div class=" flex flex-row gap-2" style="font-size: 15px">

                                            <a href="/employees/{{ $employee->id }}/edit"
                                                class="bg-gray-700 rounded text-white py-1 px-5"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                            </a>


                                            <form method="POST" action="/employees/{{ $employee->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-gray-900 rounded text-white py-1 px-5">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                </x-card>
                @endforeach
            @else
                <p>No Employees found</p>
            @endunless

        </div>

        <div class="mt-6 p-4 lg:mx-10">
            {{ $employees->links() }}
        </div>
        </div>
    @else
        @include('components.login-first')
    @endauth
</x-layout>
