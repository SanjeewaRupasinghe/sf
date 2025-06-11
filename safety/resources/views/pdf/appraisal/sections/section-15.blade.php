<div>
    <div>
        <div class="section-header">
            Section 15 of 21
            <br>Supporting Information
        </div>

        <div class="section-content">

            <p class="text-primary">
                The following is a self-populating list of all of the documents that you have attached within this form,
                agreed to email to your appraiser in advance or
                provide in hard copy format. If you cannot see a particular item in this list, go back to the section
                and
                check the document attached, or that you
                clicked the ‘Log’ button to add a listing to this table.
            </p>

            <p>
                Please be mindful of attachment sizes. Scroll down to the bottom of the table to see the total size of
                attachments in this form; please ensure it is under
                10MB to enable easy file transfer.
                <br>
                <br>
                Should you wish to add any further documentation or delete any attachments, please return to the
                appropriate
                section.
            </p>


            <div class="form-row">
                <table class="form-table">
                    <thead>
                        <tr>
                            <th>Relevant job title or role</th>
                            <th>Details
                            </th>
                            <th>Size<br>(MB)</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($appraisalData['an_new_filename'])
                            <tr>
                                <td></td>
                                <td>{{ $appraisalData['an_new_filename'] ?? '' }}</td>
                                <td></td>
                                <td>]
                                    <a class="primary-button"
                                        href="{{ route('appraisal.user.download.file', ['file' => $appraisalData['an_new_filename']]) }}">View</a>
                                </td>
                            </tr>
                        @endif
                        @if (isset($appraisalData['cpd_roles']) && is_array($appraisalData['cpd_roles']))
                            @foreach ($appraisalData['cpd_roles'] as $r)
                                @if ($r->supportingInfo == 'Attached')
                                    <tr>
                                        <td>{{ $r->roles ?? '' }}</td>
                                        <td>{{ $r->new_filename ?? '' }}</td>
                                        <td></td>
                                        <td>
                                            @php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            @endphp
                                            @if ($att)
                                                <a class="primary-button"
                                                    href="{{ route('appraisal.user.download.file', ['file' => $r->new_filename]) }}">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        @if (isset($appraisalData['qi_roles']) && is_array($appraisalData['qi_roles']))
                            @foreach ($appraisalData['qi_roles'] as $r)
                                @if ($r->supportingInfo == 'Attached')
                                    <tr>
                                        <td>{{ $r->roles ?? '' }}</td>
                                        <td>{{ $r->new_filename ?? '' }}</td>
                                        <td></td>
                                        <td>
                                            @php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            @endphp
                                            @if ($att)
                                                <a class="primary-button"
                                                    href="{{ route('appraisal.user.download.file', ['file' => $r->new_filename]) }}">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        @if (isset($appraisalData['se_roles']) && is_array($appraisalData['se_roles']))
                            @foreach ($appraisalData['se_roles'] as $r)
                                @if ($r->supportingInfo == 'Attached')
                                    <tr>
                                        <td>{{ $r->roles ?? '' }}</td>
                                        <td>{{ $r->new_filename ?? '' }}</td>
                                        <td></td>
                                        <td>
                                            @php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            @endphp
                                            @if ($att)
                                                <a class="primary-button"
                                                    href="{{ route('appraisal.user.download.file', ['file' => $r->new_filename]) }}">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        @if (isset($appraisalData['fb_roles']) && is_array($appraisalData['fb_roles']))
                            @foreach ($appraisalData['fb_roles'] as $r)
                                @if ($r->supportingInfo == 'Attached')
                                    <tr>
                                        <td>{{ $r->roles ?? '' }}</td>
                                        <td>{{ $r->new_filename ?? '' }}</td>
                                        <td></td>
                                        <td>
                                            @php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            @endphp
                                            @if ($att)
                                                <a class="primary-button"
                                                    href="{{ route('appraisal.user.download.file', ['file' => $r->new_filename]) }}">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        @if (isset($appraisalData['com_roles']) && is_array($appraisalData['com_roles']))
                            @foreach ($appraisalData['com_roles'] as $r)
                                @if ($r->supportingInfo == 'Attached')
                                    <tr>
                                        <td>{{ $r->roles ?? '' }}</td>
                                        <td>{{ $r->new_filename ?? '' }}</td>
                                        <td></td>
                                        <td>
                                            @php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            @endphp
                                            @if ($att)
                                                <a class="primary-button"
                                                    href="{{ route('appraisal.user.download.file', ['file' => $r->new_filename]) }}">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        @if (isset($appraisalData['ad_roles']) && is_array($appraisalData['ad_roles']))
                            @foreach ($appraisalData['ad_roles'] as $r)
                                @if ($r->supportingInfo == 'Attached')
                                    <tr>
                                        <td>{{ $r->roles ?? '' }}</td>
                                        <td>{{ $r->new_filename ?? '' }}</td>
                                        <td></td>
                                        <td>
                                            @php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            @endphp
                                            @if ($att)
                                                <a class="primary-button"
                                                    href="{{ route('appraisal.user.download.file', ['file' => $r->new_filename]) }}">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
