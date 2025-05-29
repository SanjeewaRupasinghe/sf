@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Supporting Information')

@section('content')
    <div class="content-header">
        <h1>Section 15 of 21</h1>
        <h2>Supporting Information
        </h2>
    </div>

    @include('common.alert')

    @php
        $content = json_decode(Auth::user()->content);

        // dd($content->cpd->roles);

        $an_new_filename = '';
        $cpd_roles = null;
        $qi_roles = null;
        $si_roles = null;
        $fb_roles = null;
        $com_roles = null;
        $ad_roles = null;

        try {
            if ($content->annualAppraisals) {
                $an_new_filename = $content->annualAppraisals->new_filename;
            }
        } catch (\Throwable $th) {
        }
        try {
            if ($content->cpd) {
                $cpd_roles = $content->cpd->roles;
            }
        } catch (\Throwable $th) {
        }
        try {
            if ($content->qualityImprovement) {
                $qi_roles = $content->qualityImprovement->roles;
            }
        } catch (\Throwable $th) {
        }
        try {
            if ($content->significantEvents) {
                $si_roles = $content->significantEvents->roles;
            }
        } catch (\Throwable $th) {
        }
        try {
            if ($content->feedback) {
                $fb_roles = $content->feedback->roles;
            }
        } catch (\Throwable $th) {
        }        
        try {
            if ($content->complaints) {
                $com_roles = $content->complaints->roles;
            }
        } catch (\Throwable $th) {
        }
        try {
            if ($content->complaints) {
                $ad_roles = $content->additionalInfo->roles;
            }
        } catch (\Throwable $th) {
        }

    @endphp

    <div>
        @csrf
        <div class="content-body">

            <p class="text-primary">
                The following is a self-populating list of all of the documents that you have attached within this form,
                agreed to email to your appraiser in advance or
                provide in hard copy format. If you cannot see a particular item in this list, go back to the section and
                check the document attached, or that you
                clicked the ‘Log’ button to add a listing to this table.
            </p>

            <p>
                Please be mindful of attachment sizes. Scroll down to the bottom of the table to see the total size of
                attachments in this form; please ensure it is under
                10MB to enable easy file transfer.
                <br>
                <br>
                Should you wish to add any further documentation or delete any attachments, please return to the appropriate
                section.
            </p>

            <!-- Table Section -->
            <div id="">

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th>Relevant job title or role</th>
                                <th>Details</th>
                                <th>Size</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody id="cpdTableBody">
                            @if ($an_new_filename > 0)
                                <tr>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $an_new_filename }}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('appraisal.user.file.download', ['fileName' => $an_new_filename]) }}">View</a>
                                    </td>
                                </tr>
                            @endif
                            @if ($cpd_roles > 0)
                                @foreach ($cpd_roles as $item)
                                    @if ($item->supportingInfo == 'Attached')
                                        <tr>
                                            <td>
                                                {{ $item->roles }}
                                            </td>
                                            <td>
                                                {{ $item->new_filename }}
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('appraisal.user.file.download', ['fileName' => $item->new_filename]) }}">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            @if ($qi_roles > 0)
                                @foreach ($qi_roles as $item)
                                    @if ($item->supportingInfo == 'Attached')
                                        <tr>
                                            <td>
                                                {{ $item->roles }}
                                            </td>
                                            <td>
                                                {{ $item->new_filename }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('appraisal.user.file.download', ['fileName' => $item->new_filename]) }}">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            @if ($si_roles > 0)
                                @foreach ($si_roles as $item)
                                    @if ($item->supportingInfo == 'Attached')
                                        <tr>
                                            <td>
                                                {{ $item->roles }}
                                            </td>
                                            <td>
                                                {{ $item->new_filename }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('appraisal.user.file.download', ['fileName' => $item->new_filename]) }}">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            @if ($fb_roles > 0)
                                @foreach ($fb_roles as $item)
                                    @if ($item->supportingInfo == 'Attached')
                                        <tr>
                                            <td>
                                                {{ $item->roles }}
                                            </td>
                                            <td>
                                                {{ $item->new_filename }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('appraisal.user.file.download', ['fileName' => $item->new_filename]) }}">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            @if ($com_roles > 0)
                                @foreach ($com_roles as $item)
                                    @if ($item->supportingInfo == 'Attached')
                                        <tr>
                                            <td>
                                                {{ $item->roles }}
                                            </td>
                                            <td>
                                                {{ $item->new_filename }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('appraisal.user.file.download', ['fileName' => $item->new_filename]) }}">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            @if ($ad_roles > 0)
                                @foreach ($ad_roles as $item)
                                    @if ($item->supportingInfo == 'Attached')
                                        <tr>
                                            <td>
                                                {{ $item->roles }}
                                            </td>
                                            <td>
                                                {{ $item->new_filename }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('appraisal.user.file.download', ['fileName' => $item->new_filename]) }}">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #f8f9fa;">
                                <td colspan="3"><strong>Total Attachment:</strong></td>
                                <td><strong></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

        </div>

        <div class="d-flex justify-content-between px-3 pb-5">
            <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.additional-info')}}">
                < Previous section</a>
                    <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.gmc-domains')}}">Next section ></a>
        </div>

    </div>

@endsection
