<?php

namespace App\Exports;

use App\Models\Transaksi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class TransaksiExport implements FromCollection, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */


    private $no = -1;
    private $start_date;
    private $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        // Mendapatkan tanggal mulai dan tanggal akhir dari parameter
        $start_date = Carbon::parse($this->start_date)->startOfDay();
        $end_date = Carbon::parse($this->end_date)->endOfDay();

        // Mengambil data transaksi sesuai dengan rentang tanggal
        return Transaksi::whereBetween('tanggal_muat', [$start_date, $end_date])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
        ];
    }

    public function map($transaksi): array
    {
        return [
            $this->no++,
            $transaksi->tanggal_muat,
            $transaksi->fo,
            $transaksi->fu,
            $transaksi->nomor_polisi,
            $transaksi->driver,
            $transaksi->jenis_armada,
            $transaksi->nama_customer,
            $transaksi->alamat_kirim,
            $transaksi->ongkos_angkut,
            $transaksi->biaya_rcf,
            $transaksi->biaya_return,
            $transaksi->biaya_inap,
            $transaksi->multi_drop,
            $transaksi->tob,
            $transaksi->total_biaya,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Load the template
                $templateFilePath = storage_path('app/excel/template.xlsx');
                $templateSpreadsheet = IOFactory::load($templateFilePath);
                $templateSheet = $templateSpreadsheet->getActiveSheet();

                // Copy data from template to the new sheet
                $sheet = $event->sheet->getDelegate();

                foreach ($templateSheet->getRowIterator() as $row) {
                    foreach ($row->getCellIterator() as $cell) {
                        $cellCoordinate = $cell->getCoordinate();
                        $sheet->setCellValue($cellCoordinate, $cell->getValue());
                    }
                }

                // Place the data from the collection starting at a specific row, for example, row 5
                $startRow = 7;
                foreach ($this->collection() as $index => $transaksi) {
                    $mappedData = $this->map($transaksi);
                    foreach ($mappedData as $key => $value) {
                        $sheet->setCellValueByColumnAndRow($key + 1, $startRow + $index, $value);
                    }
                }

                // Define the cell range for data
                $endRow = ($startRow - 1) + $this->collection()->count();
                $cellRange = 'A' . ($startRow -1) . ':P' . $endRow;

                // Apply border style to the cell range
                $sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THICK,
                            'color' => ['argb' => 'ff0000cc'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
