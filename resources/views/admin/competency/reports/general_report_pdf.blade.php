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
                    Participants ID
                </th>

                <th>
                    CESNO
                </th>

                <th>
                    Name
                </th>

                <th>
                    CES Status
                </th>

                <th>
                    Training Status
                </th>

                <th>
                    No. of Training Hours
                </th>

                <th>
                    Payment Status
                </th>

                <th>
                    Remarks
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($trainingParticipantList as $trainingParticipantLists)
                <tr>
                    <td>
                        {{ $trainingParticipantLists->pid }}
                    </td>

                    <td>
                        {{ $trainingParticipantLists->cesno }}
                    </td>

                    <td>
                        {{ 
                            $trainingParticipantLists->cesTrainingPersonalData->lastname.', '.$trainingParticipantLists->cesTrainingPersonalData->firstname.', '.$trainingParticipantLists->cesTrainingPersonalData->name_extension.', '.$trainingParticipantLists->cesTrainingPersonalData->middleinitial 
                        }}
                    </td>

                    <td>
                        {{-- {{ $training->specialization }} --}}
                    </td>

                    <td>
                        {{ $trainingParticipantLists->status }}
                    </td>

                    <td>
                        {{ $trainingParticipantLists->no_hours }}
                    </td>

                    <td>
                        {{ $trainingParticipantLists->payment }}
                    </td>

                    <td>
                        {{ $trainingParticipantLists->remarks }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>