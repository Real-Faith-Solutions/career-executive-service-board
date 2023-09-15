<style>
    table {
        border-collapse: collapse;
        margin-top: 50px;
        padding-left: 30px;
        padding-right: 30px;
        width: 100%;
    }

    td, th {
        /* border: 1px groove black; */
        /* padding: 10px; */
        text-align: center;
    }

    td {
        padding: 6px;
        font-size: 13px;
        text-align: left;
    }

    th {
        color: #284F87;
        font-size: 15px;
        text-transform: uppercase;
        padding-bottom: 5px;
        background-color: white;
    }

    tr:nth-child(even) {
        /* background-color: #6aabd1; */
        background-color: #DCD6D0;
    }

    /* tr:nth-child(odd) {
        background-color: #DCD6D0;
    } */

    .container {
        text-align: center;
    }

    .title {
        margin-top: -20px;
    }

    .title_name {
        text-transform: uppercase;
        font-size: 20px;
        color: #284F87;
    }

    .title_street {
        margin-top: -20px;
        font-size: 12px;
    }

    .link {
        margin-top: -7px;
        font-size: 15px;
    }

    .thead {
        font-size: 13px;
    }
</style>

<div class="container">
    <div class="logo">
        <img src="{{ public_path("images/branding.png") }}" alt="" style="width: 150px; height: 150px;">
    </div>

    <div class="title">
        <p class="title_name">Career Executive Service Board</p>
        <p class="title_street">No. 3 Marcelino St., Isidora Hills, Holy Spirit Drive, Diliman, Quezon City 1127</p>
        <p class="link"><a href="www.cesboard.gov.ph" target="_blank">www.cesboard.gov.ph</a></p>
    </div>
</div>

<div>
    <table>
        <thead>
            <tr>
                <th class="thead">
                    Venue
                </th>

                <th class="thead">
                    Address
                </th>

                <th class="thead">
                    Contact No.
                </th>

                <th class="thead">
                    Email
                </th>

                <th class="thead">
                    Contact Person
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainingVenueManager as $trainingVenueManagers)
                <tr>
                    <td class="first_row">
                        {{ $trainingVenueManagers->name }}
                    </td>

                    <td >
                        {{ 
                            $trainingVenueManagers->no_street.', '.
                            $trainingVenueManagers->brgy.', '. 
                            $trainingVenueManagers->trainingVenueManager->name
                        }}
                    </td>

                    <td >
                        {{ $trainingVenueManagers->contactno }}
                    </td>

                    <td >
                        {{ $trainingVenueManagers->emailadd }}
                    </td>

                    <td >
                        {{ $trainingVenueManagers->contactperson }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>