<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid black;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #d3d3d3;
    }

    tr:nth-child(even) {
        background-color: #b0d1e4;
    }

    tr:nth-child(odd) {
        background-color: #6aabd1;
    }
</style>

<div>
    <table>
        <thead>
            <tr>
                <th>
                    Provider
                </th>

                <th>
                    House Building
                </th>

                <th>
                    St. Road
                </th>

                <th>
                    Barangay/Village
                </th>

                <th>
                    City Code
                </th>

                <th>
                    Contact No.
                </th>

                <th>
                    Email
                </th>

                <th>
                    Contact Person
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($competencyTrainingProvider as $competencyTrainingProviders)
                <tr>
                    <td>
                        {{ $competencyTrainingProviders->provider }}
                    </td>

                    <td>
                        {{ $competencyTrainingProviders->house_bldg }}
                    </td>

                    <td>
                        {{ $competencyTrainingProviders->st_road }}
                    </td>

                    <td>
                        {{ $competencyTrainingProviders->brgy_vill }}
                    </td>

                    <td>
                        {{ $competencyTrainingProviders->trainingProviderManager->name }}
                    </td>

                    <td>
                        {{ $competencyTrainingProviders->contactno }}
                    </td>

                    <td>
                        {{ $competencyTrainingProviders->emailadd }}
                    </td>

                    <td>
                        {{ $competencyTrainingProviders->contactperson }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>