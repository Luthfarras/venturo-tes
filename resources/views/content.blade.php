
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header">
            Venturo - Laporan Penjualan tahunan per menu
        </div>
        <div class="card-body">
            <form action="{{ url('tampil') }}" method="POST">
                <div class="d-flex flex-row">
                    <div class="">
                        @csrf
                        <select name="tahun" class="form-select" aria-label="Default select example">
                            <option value="">Pilih Tahun</option>
                            <option value="2021" @selected($tahun == 2021)>2021</option>
                            <option value="2022" @selected($tahun == 2022)>2022</option>
                        </select>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary ms-3">Tampilkan</button>
                    </div>
                    @isset($data)
                        <div class="">
                            <a href="http://tes-web.landa.id/intermediate/menu" class="btn btn-secondary ms-3">JSON Menu</a>
                        </div>
                        <div class="">
                            <a href="{{ url('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun) }}" class="btn btn-secondary ms-3">JSON Transaksi</a>
                        </div>
                    @endisset
                </div>
            </form>
        </div>
        @isset($data)
        <hr>
            <div class="container-fluid">
                <table class="table">
                    <thead>
                        <tr class="table-dark">
                            <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">
                                Menu</th>
                            <th colspan="12" style="text-align: center;">Periode Pada {{ $tahun }}</th>
                            <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total
                            </th>
                        </tr>
                        <tr class="table-dark">
                            <th style="text-align: center;width: 75px;">Jan</th>
                            <th style="text-align: center;width: 75px;">Feb</th>
                            <th style="text-align: center;width: 75px;">Mar</th>
                            <th style="text-align: center;width: 75px;">Apr</th>
                            <th style="text-align: center;width: 75px;">Mei</th>
                            <th style="text-align: center;width: 75px;">Jun</th>
                            <th style="text-align: center;width: 75px;">Jul</th>
                            <th style="text-align: center;width: 75px;">Ags</th>
                            <th style="text-align: center;width: 75px;">Sep</th>
                            <th style="text-align: center;width: 75px;">Okt</th>
                            <th style="text-align: center;width: 75px;">Nov</th>
                            <th style="text-align: center;width: 75px;">Des</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-secondary" id="kategori" colspan="14"><b>Makanan</b></td>
                        </tr>
                        @foreach ($menu as $item)
                            @if ($item->kategori == 'makanan')
                                <tr>
                                    <td>{{ $item->menu }}</td>
                                    @for ($i = 1; $i <= 12; $i++)
                                    @if ($result[$item->menu][$i] == 0)
                                        <td></td>
                                    @else
                                    <td>{{ number_format($result[$item->menu][$i], 0, ',', '.') }}</td>
                                    @endif
                                    @endfor

                                    <td class="fw-bold">{{ number_format($jumlahmenu[$item->menu], 0, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach

                        <tr>
                            <td class="table-secondary" id="kategori" colspan="14"><b>Minuman</b></td>
                        </tr>
                        @foreach ($menu as $item)
                            @if ($item->kategori == 'minuman')
                                <tr>
                                    <td>{{ $item->menu }}</td>
                                    @for ($i = 1; $i <= 12; $i++)
                                    @if ($result[$item->menu][$i] == 0)
                                        <td></td>
                                    @else
                                    <td>{{ number_format($result[$item->menu][$i], 0, ',', '.') }}</td>
                                    @endif
                                    @endfor
                                    <td class="fw-bold">{{ number_format($jumlahmenu[$item->menu], 0, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach


                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <td class="fw-bold">Total</td>

                            {{-- Pengulangan untuk mengambil nilai bulan --}}
                            @for ($i = 1; $i <= 12; $i++)
                            @if ($jumlah[$i] == 0)
                            <td></td>
                            @else
                                <td class="fw-bold">{{ number_format($jumlah[$i], 0, ',', '.') }}</td>
                            @endif    
                            @endfor

                            {{-- Hasil Total --}}
                            <td class="fw-bold">{{ number_format($nilai, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        @endisset
    </div>

</div>
</div>
</div>