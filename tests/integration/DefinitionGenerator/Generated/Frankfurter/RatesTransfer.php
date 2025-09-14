<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Frankfurter;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/frankfurter-dev-v1/definition/exchangeRate.transfer.yml Definition file path.
 */
final class RatesTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 30;

    protected const array META_DATA = [
        self::AUD_INDEX => self::AUD,
        self::BGN_INDEX => self::BGN,
        self::BRL_INDEX => self::BRL,
        self::CAD_INDEX => self::CAD,
        self::CHF_INDEX => self::CHF,
        self::CNY_INDEX => self::CNY,
        self::CZK_INDEX => self::CZK,
        self::DKK_INDEX => self::DKK,
        self::GBP_INDEX => self::GBP,
        self::HKD_INDEX => self::HKD,
        self::HUF_INDEX => self::HUF,
        self::IDR_INDEX => self::IDR,
        self::ILS_INDEX => self::ILS,
        self::INR_INDEX => self::INR,
        self::ISK_INDEX => self::ISK,
        self::JPY_INDEX => self::JPY,
        self::KRW_INDEX => self::KRW,
        self::MXN_INDEX => self::MXN,
        self::MYR_INDEX => self::MYR,
        self::NOK_INDEX => self::NOK,
        self::NZD_INDEX => self::NZD,
        self::PHP_INDEX => self::PHP,
        self::PLN_INDEX => self::PLN,
        self::RON_INDEX => self::RON,
        self::SEK_INDEX => self::SEK,
        self::SGD_INDEX => self::SGD,
        self::THB_INDEX => self::THB,
        self::TRY_INDEX => self::TRY,
        self::USD_INDEX => self::USD,
        self::ZAR_INDEX => self::ZAR,
    ];

    // AUD
    public const string AUD = 'AUD';
    protected const int AUD_INDEX = 0;

    public ?float $AUD {
        get => $this->getData(self::AUD_INDEX);
        set => $this->setData(self::AUD_INDEX, $value);
    }

    // BGN
    public const string BGN = 'BGN';
    protected const int BGN_INDEX = 1;

    public ?float $BGN {
        get => $this->getData(self::BGN_INDEX);
        set => $this->setData(self::BGN_INDEX, $value);
    }

    // BRL
    public const string BRL = 'BRL';
    protected const int BRL_INDEX = 2;

    public ?float $BRL {
        get => $this->getData(self::BRL_INDEX);
        set => $this->setData(self::BRL_INDEX, $value);
    }

    // CAD
    public const string CAD = 'CAD';
    protected const int CAD_INDEX = 3;

    public ?float $CAD {
        get => $this->getData(self::CAD_INDEX);
        set => $this->setData(self::CAD_INDEX, $value);
    }

    // CHF
    public const string CHF = 'CHF';
    protected const int CHF_INDEX = 4;

    public ?float $CHF {
        get => $this->getData(self::CHF_INDEX);
        set => $this->setData(self::CHF_INDEX, $value);
    }

    // CNY
    public const string CNY = 'CNY';
    protected const int CNY_INDEX = 5;

    public ?float $CNY {
        get => $this->getData(self::CNY_INDEX);
        set => $this->setData(self::CNY_INDEX, $value);
    }

    // CZK
    public const string CZK = 'CZK';
    protected const int CZK_INDEX = 6;

    public ?float $CZK {
        get => $this->getData(self::CZK_INDEX);
        set => $this->setData(self::CZK_INDEX, $value);
    }

    // DKK
    public const string DKK = 'DKK';
    protected const int DKK_INDEX = 7;

    public ?float $DKK {
        get => $this->getData(self::DKK_INDEX);
        set => $this->setData(self::DKK_INDEX, $value);
    }

    // GBP
    public const string GBP = 'GBP';
    protected const int GBP_INDEX = 8;

    public ?float $GBP {
        get => $this->getData(self::GBP_INDEX);
        set => $this->setData(self::GBP_INDEX, $value);
    }

    // HKD
    public const string HKD = 'HKD';
    protected const int HKD_INDEX = 9;

    public ?float $HKD {
        get => $this->getData(self::HKD_INDEX);
        set => $this->setData(self::HKD_INDEX, $value);
    }

    // HUF
    public const string HUF = 'HUF';
    protected const int HUF_INDEX = 10;

    public ?float $HUF {
        get => $this->getData(self::HUF_INDEX);
        set => $this->setData(self::HUF_INDEX, $value);
    }

    // IDR
    public const string IDR = 'IDR';
    protected const int IDR_INDEX = 11;

    public ?int $IDR {
        get => $this->getData(self::IDR_INDEX);
        set => $this->setData(self::IDR_INDEX, $value);
    }

    // ILS
    public const string ILS = 'ILS';
    protected const int ILS_INDEX = 12;

    public ?float $ILS {
        get => $this->getData(self::ILS_INDEX);
        set => $this->setData(self::ILS_INDEX, $value);
    }

    // INR
    public const string INR = 'INR';
    protected const int INR_INDEX = 13;

    public ?float $INR {
        get => $this->getData(self::INR_INDEX);
        set => $this->setData(self::INR_INDEX, $value);
    }

    // ISK
    public const string ISK = 'ISK';
    protected const int ISK_INDEX = 14;

    public ?float $ISK {
        get => $this->getData(self::ISK_INDEX);
        set => $this->setData(self::ISK_INDEX, $value);
    }

    // JPY
    public const string JPY = 'JPY';
    protected const int JPY_INDEX = 15;

    public ?float $JPY {
        get => $this->getData(self::JPY_INDEX);
        set => $this->setData(self::JPY_INDEX, $value);
    }

    // KRW
    public const string KRW = 'KRW';
    protected const int KRW_INDEX = 16;

    public ?float $KRW {
        get => $this->getData(self::KRW_INDEX);
        set => $this->setData(self::KRW_INDEX, $value);
    }

    // MXN
    public const string MXN = 'MXN';
    protected const int MXN_INDEX = 17;

    public ?float $MXN {
        get => $this->getData(self::MXN_INDEX);
        set => $this->setData(self::MXN_INDEX, $value);
    }

    // MYR
    public const string MYR = 'MYR';
    protected const int MYR_INDEX = 18;

    public ?float $MYR {
        get => $this->getData(self::MYR_INDEX);
        set => $this->setData(self::MYR_INDEX, $value);
    }

    // NOK
    public const string NOK = 'NOK';
    protected const int NOK_INDEX = 19;

    public ?float $NOK {
        get => $this->getData(self::NOK_INDEX);
        set => $this->setData(self::NOK_INDEX, $value);
    }

    // NZD
    public const string NZD = 'NZD';
    protected const int NZD_INDEX = 20;

    public ?float $NZD {
        get => $this->getData(self::NZD_INDEX);
        set => $this->setData(self::NZD_INDEX, $value);
    }

    // PHP
    public const string PHP = 'PHP';
    protected const int PHP_INDEX = 21;

    public ?float $PHP {
        get => $this->getData(self::PHP_INDEX);
        set => $this->setData(self::PHP_INDEX, $value);
    }

    // PLN
    public const string PLN = 'PLN';
    protected const int PLN_INDEX = 22;

    public ?float $PLN {
        get => $this->getData(self::PLN_INDEX);
        set => $this->setData(self::PLN_INDEX, $value);
    }

    // RON
    public const string RON = 'RON';
    protected const int RON_INDEX = 23;

    public ?float $RON {
        get => $this->getData(self::RON_INDEX);
        set => $this->setData(self::RON_INDEX, $value);
    }

    // SEK
    public const string SEK = 'SEK';
    protected const int SEK_INDEX = 24;

    public ?float $SEK {
        get => $this->getData(self::SEK_INDEX);
        set => $this->setData(self::SEK_INDEX, $value);
    }

    // SGD
    public const string SGD = 'SGD';
    protected const int SGD_INDEX = 25;

    public ?float $SGD {
        get => $this->getData(self::SGD_INDEX);
        set => $this->setData(self::SGD_INDEX, $value);
    }

    // THB
    public const string THB = 'THB';
    protected const int THB_INDEX = 26;

    public ?float $THB {
        get => $this->getData(self::THB_INDEX);
        set => $this->setData(self::THB_INDEX, $value);
    }

    // TRY
    public const string TRY = 'TRY';
    protected const int TRY_INDEX = 27;

    public ?float $TRY {
        get => $this->getData(self::TRY_INDEX);
        set => $this->setData(self::TRY_INDEX, $value);
    }

    // USD
    public const string USD = 'USD';
    protected const int USD_INDEX = 28;

    public ?float $USD {
        get => $this->getData(self::USD_INDEX);
        set => $this->setData(self::USD_INDEX, $value);
    }

    // ZAR
    public const string ZAR = 'ZAR';
    protected const int ZAR_INDEX = 29;

    public ?float $ZAR {
        get => $this->getData(self::ZAR_INDEX);
        set => $this->setData(self::ZAR_INDEX, $value);
    }
}
