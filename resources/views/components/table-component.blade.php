<div class="bg-white rounded-2xl shadow-lg  mx-autp my-3 p-4 font-Poppins max-h-96 min-h-96 ">
    <h2 class="text-neutral-950 text-left text-xl md:text-2xl lg:text-2xl font-semibold my-4 ">{{ $title }}</h2>
    <div class="max-h-72 overflow-y-auto">
        <table class="min-w-full text-left overflow-y-auto ">
            <thead>
                <tr class="text-sm font-medium text-gray-700  rounded-lg">
                    @foreach ($headers as $header )
                        <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($rows as $row)
                    <tr class="hover:bg-gray-50 transition-colors" >
                        @foreach($row as $cell)
                            <td class="px-6 py-4 border-b border-gray-200 text-gray-900">{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
