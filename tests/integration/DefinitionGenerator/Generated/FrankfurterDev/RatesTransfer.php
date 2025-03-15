<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\FrankfurterDev;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class RatesTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 30;

    protected const array META_DATA = [
        self::AUD => self::AUD_DATA_NAME,
        self::BGN => self::BGN_DATA_NAME,
        self::BRL => self::BRL_DATA_NAME,
        self::CAD => self::CAD_DATA_NAME,
        self::CHF => self::CHF_DATA_NAME,
        self::CNY => self::CNY_DATA_NAME,
        self::CZK => self::CZK_DATA_NAME,
        self::DKK => self::DKK_DATA_NAME,
        self::GBP => self::GBP_DATA_NAME,
        self::HKD => self::HKD_DATA_NAME,
        self::HUF => self::HUF_DATA_NAME,
        self::IDR => self::IDR_DATA_NAME,
        self::ILS => self::ILS_DATA_NAME,
        self::INR => self::INR_DATA_NAME,
        self::ISK => self::ISK_DATA_NAME,
        self::JPY => self::JPY_DATA_NAME,
        self::KRW => self::KRW_DATA_NAME,
        self::MXN => self::MXN_DATA_NAME,
        self::MYR => self::MYR_DATA_NAME,
        self::NOK => self::NOK_DATA_NAME,
        self::NZD => self::NZD_DATA_NAME,
        self::PHP => self::PHP_DATA_NAME,
        self::PLN => self::PLN_DATA_NAME,
        self::RON => self::RON_DATA_NAME,
        self::SEK => self::SEK_DATA_NAME,
        self::SGD => self::SGD_DATA_NAME,
        self::THB => self::THB_DATA_NAME,
        self::TRY => self::TRY_DATA_NAME,
        self::USD => self::USD_DATA_NAME,
        self::ZAR => self::ZAR_DATA_NAME,
    ];

    // aud
    public const string AUD = 'aud';
    protected const string AUD_DATA_NAME = 'AUD';
    protected const int AUD_DATA_INDEX = 0;

    public ?float $aud {
        get => $this->getData(self::AUD_DATA_INDEX);
        set => $this->setData(self::AUD_DATA_INDEX, $value);
    }

    // bgn
    public const string BGN = 'bgn';
    protected const string BGN_DATA_NAME = 'BGN';
    protected const int BGN_DATA_INDEX = 1;

    public ?float $bgn {
        get => $this->getData(self::BGN_DATA_INDEX);
        set => $this->setData(self::BGN_DATA_INDEX, $value);
    }

    // brl
    public const string BRL = 'brl';
    protected const string BRL_DATA_NAME = 'BRL';
    protected const int BRL_DATA_INDEX = 2;

    public ?float $brl {
        get => $this->getData(self::BRL_DATA_INDEX);
        set => $this->setData(self::BRL_DATA_INDEX, $value);
    }

    // cad
    public const string CAD = 'cad';
    protected const string CAD_DATA_NAME = 'CAD';
    protected const int CAD_DATA_INDEX = 3;

    public ?float $cad {
        get => $this->getData(self::CAD_DATA_INDEX);
        set => $this->setData(self::CAD_DATA_INDEX, $value);
    }

    // chf
    public const string CHF = 'chf';
    protected const string CHF_DATA_NAME = 'CHF';
    protected const int CHF_DATA_INDEX = 4;

    public ?float $chf {
        get => $this->getData(self::CHF_DATA_INDEX);
        set => $this->setData(self::CHF_DATA_INDEX, $value);
    }

    // cny
    public const string CNY = 'cny';
    protected const string CNY_DATA_NAME = 'CNY';
    protected const int CNY_DATA_INDEX = 5;

    public ?float $cny {
        get => $this->getData(self::CNY_DATA_INDEX);
        set => $this->setData(self::CNY_DATA_INDEX, $value);
    }

    // czk
    public const string CZK = 'czk';
    protected const string CZK_DATA_NAME = 'CZK';
    protected const int CZK_DATA_INDEX = 6;

    public ?float $czk {
        get => $this->getData(self::CZK_DATA_INDEX);
        set => $this->setData(self::CZK_DATA_INDEX, $value);
    }

    // dkk
    public const string DKK = 'dkk';
    protected const string DKK_DATA_NAME = 'DKK';
    protected const int DKK_DATA_INDEX = 7;

    public ?float $dkk {
        get => $this->getData(self::DKK_DATA_INDEX);
        set => $this->setData(self::DKK_DATA_INDEX, $value);
    }

    // gbp
    public const string GBP = 'gbp';
    protected const string GBP_DATA_NAME = 'GBP';
    protected const int GBP_DATA_INDEX = 8;

    public ?float $gbp {
        get => $this->getData(self::GBP_DATA_INDEX);
        set => $this->setData(self::GBP_DATA_INDEX, $value);
    }

    // hkd
    public const string HKD = 'hkd';
    protected const string HKD_DATA_NAME = 'HKD';
    protected const int HKD_DATA_INDEX = 9;

    public ?float $hkd {
        get => $this->getData(self::HKD_DATA_INDEX);
        set => $this->setData(self::HKD_DATA_INDEX, $value);
    }

    // huf
    public const string HUF = 'huf';
    protected const string HUF_DATA_NAME = 'HUF';
    protected const int HUF_DATA_INDEX = 10;

    public ?float $huf {
        get => $this->getData(self::HUF_DATA_INDEX);
        set => $this->setData(self::HUF_DATA_INDEX, $value);
    }

    // idr
    public const string IDR = 'idr';
    protected const string IDR_DATA_NAME = 'IDR';
    protected const int IDR_DATA_INDEX = 11;

    public ?int $idr {
        get => $this->getData(self::IDR_DATA_INDEX);
        set => $this->setData(self::IDR_DATA_INDEX, $value);
    }

    // ils
    public const string ILS = 'ils';
    protected const string ILS_DATA_NAME = 'ILS';
    protected const int ILS_DATA_INDEX = 12;

    public ?float $ils {
        get => $this->getData(self::ILS_DATA_INDEX);
        set => $this->setData(self::ILS_DATA_INDEX, $value);
    }

    // inr
    public const string INR = 'inr';
    protected const string INR_DATA_NAME = 'INR';
    protected const int INR_DATA_INDEX = 13;

    public ?float $inr {
        get => $this->getData(self::INR_DATA_INDEX);
        set => $this->setData(self::INR_DATA_INDEX, $value);
    }

    // isk
    public const string ISK = 'isk';
    protected const string ISK_DATA_NAME = 'ISK';
    protected const int ISK_DATA_INDEX = 14;

    public ?float $isk {
        get => $this->getData(self::ISK_DATA_INDEX);
        set => $this->setData(self::ISK_DATA_INDEX, $value);
    }

    // jpy
    public const string JPY = 'jpy';
    protected const string JPY_DATA_NAME = 'JPY';
    protected const int JPY_DATA_INDEX = 15;

    public ?float $jpy {
        get => $this->getData(self::JPY_DATA_INDEX);
        set => $this->setData(self::JPY_DATA_INDEX, $value);
    }

    // krw
    public const string KRW = 'krw';
    protected const string KRW_DATA_NAME = 'KRW';
    protected const int KRW_DATA_INDEX = 16;

    public ?float $krw {
        get => $this->getData(self::KRW_DATA_INDEX);
        set => $this->setData(self::KRW_DATA_INDEX, $value);
    }

    // mxn
    public const string MXN = 'mxn';
    protected const string MXN_DATA_NAME = 'MXN';
    protected const int MXN_DATA_INDEX = 17;

    public ?float $mxn {
        get => $this->getData(self::MXN_DATA_INDEX);
        set => $this->setData(self::MXN_DATA_INDEX, $value);
    }

    // myr
    public const string MYR = 'myr';
    protected const string MYR_DATA_NAME = 'MYR';
    protected const int MYR_DATA_INDEX = 18;

    public ?float $myr {
        get => $this->getData(self::MYR_DATA_INDEX);
        set => $this->setData(self::MYR_DATA_INDEX, $value);
    }

    // nok
    public const string NOK = 'nok';
    protected const string NOK_DATA_NAME = 'NOK';
    protected const int NOK_DATA_INDEX = 19;

    public ?float $nok {
        get => $this->getData(self::NOK_DATA_INDEX);
        set => $this->setData(self::NOK_DATA_INDEX, $value);
    }

    // nzd
    public const string NZD = 'nzd';
    protected const string NZD_DATA_NAME = 'NZD';
    protected const int NZD_DATA_INDEX = 20;

    public ?float $nzd {
        get => $this->getData(self::NZD_DATA_INDEX);
        set => $this->setData(self::NZD_DATA_INDEX, $value);
    }

    // php
    public const string PHP = 'php';
    protected const string PHP_DATA_NAME = 'PHP';
    protected const int PHP_DATA_INDEX = 21;

    public ?float $php {
        get => $this->getData(self::PHP_DATA_INDEX);
        set => $this->setData(self::PHP_DATA_INDEX, $value);
    }

    // pln
    public const string PLN = 'pln';
    protected const string PLN_DATA_NAME = 'PLN';
    protected const int PLN_DATA_INDEX = 22;

    public ?float $pln {
        get => $this->getData(self::PLN_DATA_INDEX);
        set => $this->setData(self::PLN_DATA_INDEX, $value);
    }

    // ron
    public const string RON = 'ron';
    protected const string RON_DATA_NAME = 'RON';
    protected const int RON_DATA_INDEX = 23;

    public ?float $ron {
        get => $this->getData(self::RON_DATA_INDEX);
        set => $this->setData(self::RON_DATA_INDEX, $value);
    }

    // sek
    public const string SEK = 'sek';
    protected const string SEK_DATA_NAME = 'SEK';
    protected const int SEK_DATA_INDEX = 24;

    public ?float $sek {
        get => $this->getData(self::SEK_DATA_INDEX);
        set => $this->setData(self::SEK_DATA_INDEX, $value);
    }

    // sgd
    public const string SGD = 'sgd';
    protected const string SGD_DATA_NAME = 'SGD';
    protected const int SGD_DATA_INDEX = 25;

    public ?float $sgd {
        get => $this->getData(self::SGD_DATA_INDEX);
        set => $this->setData(self::SGD_DATA_INDEX, $value);
    }

    // thb
    public const string THB = 'thb';
    protected const string THB_DATA_NAME = 'THB';
    protected const int THB_DATA_INDEX = 26;

    public ?float $thb {
        get => $this->getData(self::THB_DATA_INDEX);
        set => $this->setData(self::THB_DATA_INDEX, $value);
    }

    // try
    public const string TRY = 'try';
    protected const string TRY_DATA_NAME = 'TRY';
    protected const int TRY_DATA_INDEX = 27;

    public ?float $try {
        get => $this->getData(self::TRY_DATA_INDEX);
        set => $this->setData(self::TRY_DATA_INDEX, $value);
    }

    // usd
    public const string USD = 'usd';
    protected const string USD_DATA_NAME = 'USD';
    protected const int USD_DATA_INDEX = 28;

    public ?float $usd {
        get => $this->getData(self::USD_DATA_INDEX);
        set => $this->setData(self::USD_DATA_INDEX, $value);
    }

    // zar
    public const string ZAR = 'zar';
    protected const string ZAR_DATA_NAME = 'ZAR';
    protected const int ZAR_DATA_INDEX = 29;

    public ?float $zar {
        get => $this->getData(self::ZAR_DATA_INDEX);
        set => $this->setData(self::ZAR_DATA_INDEX, $value);
    }
}
