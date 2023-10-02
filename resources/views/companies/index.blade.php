<x-layout>
    @auth
        <div class="container" style="margin-top: 5rem">
            <div class="mb-4 ml-1.5 mt-4 flex flex-row-reverse">
                <a href="/companies/create" class="bg-gray-900 rounded text-white py-2 px-5"><i class="fa-solid fa-plus"></i>
                    Create new company</a>
            </div>

            <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4 lg:ml-12">

                @unless (count($companies) == 0)
                    @foreach ($companies as $company)
                        <x-card>
                            <div class="flex">
                                <img class="hidden w-48 mr-6 md:block" style="width: 100px; height: 100px; object-fit: contain"
                                    src="{{ $company->logo ? asset('storage/' . $company->logo) : asset('/images/no-image.png') }}"
                                    alt="" />
                                <div>

                                    <h3 class="fs-1 font-bold">
                                        <a style="text-transform: uppercase">{{ $company->name }}</a>
                                    </h3>
                                    <hr />
                                    <div class="text-lg mb-2mt-2">
                                        <div>
                                            <i class="fa-solid fa-envelope"></i> {{ $company->email }}
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-globe"></i> {{ $company->website }}
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-row-reverse">
                                <div class=" flex flex-row gap-2" style="font-size: 15px">

                                    <a href="/companies/{{ $company->id }}/edit"
                                        class="bg-gray-700 rounded text-white py-1 px-5"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                    </a>


                                    <form method="POST" action="/companies/{{ $company->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-gray-900 rounded text-white py-1 px-5">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </x-card>
                    @endforeach
                @else
                    <p>No Companies found</p>
                @endunless

            </div>

            <div class="mt-6 p-4 lg:mx-10">
                {{ $companies->links() }}
            </div>
        </div>
    @else
        @include('components.login-first')
    @endauth
</x-layout>
