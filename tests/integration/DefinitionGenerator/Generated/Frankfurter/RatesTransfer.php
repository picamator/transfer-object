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

    // AUD
    public const string AUD = 'AUD';
    protected const string AUD_DATA_NAME = 'AUD';
    protected const int AUD_DATA_INDEX = 0;

    public ?float $AUD {
        get => $this->getData(self::AUD_DATA_INDEX);
        set => $this->setData(self::AUD_DATA_INDEX, $value);
    }

    // BGN
    public const string BGN = 'BGN';
    protected const string BGN_DATA_NAME = 'BGN';
    protected const int BGN_DATA_INDEX = 1;

    public ?float $BGN {
        get => $this->getData(self::BGN_DATA_INDEX);
        set => $this->setData(self::BGN_DATA_INDEX, $value);
    }

    // BRL
    public const string BRL = 'BRL';
    protected const string BRL_DATA_NAME = 'BRL';
    protected const int BRL_DATA_INDEX = 2;

    public ?float $BRL {
        get => $this->getData(self::BRL_DATA_INDEX);
        set => $this->setData(self::BRL_DATA_INDEX, $value);
    }

    // CAD
    public const string CAD = 'CAD';
    protected const string CAD_DATA_NAME = 'CAD';
    protected const int CAD_DATA_INDEX = 3;

    public ?float $CAD {
        get => $this->getData(self::CAD_DATA_INDEX);
        set => $this->setData(self::CAD_DATA_INDEX, $value);
    }

    // CHF
    public const string CHF = 'CHF';
    protected const string CHF_DATA_NAME = 'CHF';
    protected const int CHF_DATA_INDEX = 4;

    public ?float $CHF {
        get => $this->getData(self::CHF_DATA_INDEX);
        set => $this->setData(self::CHF_DATA_INDEX, $value);
    }

    // CNY
    public const string CNY = 'CNY';
    protected const string CNY_DATA_NAME = 'CNY';
    protected const int CNY_DATA_INDEX = 5;

    public ?float $CNY {
        get => $this->getData(self::CNY_DATA_INDEX);
        set => $this->setData(self::CNY_DATA_INDEX, $value);
    }

    // CZK
    public const string CZK = 'CZK';
    protected const string CZK_DATA_NAME = 'CZK';
    protected const int CZK_DATA_INDEX = 6;

    public ?float $CZK {
        get => $this->getData(self::CZK_DATA_INDEX);
        set => $this->setData(self::CZK_DATA_INDEX, $value);
    }

    // DKK
    public const string DKK = 'DKK';
    protected const string DKK_DATA_NAME = 'DKK';
    protected const int DKK_DATA_INDEX = 7;

    public ?float $DKK {
        get => $this->getData(self::DKK_DATA_INDEX);
        set => $this->setData(self::DKK_DATA_INDEX, $value);
    }

    // GBP
    public const string GBP = 'GBP';
    protected const string GBP_DATA_NAME = 'GBP';
    protected const int GBP_DATA_INDEX = 8;

    public ?float $GBP {
        get => $this->getData(self::GBP_DATA_INDEX);
        set => $this->setData(self::GBP_DATA_INDEX, $value);
    }

    // HKD
    public const string HKD = 'HKD';
    protected const string HKD_DATA_NAME = 'HKD';
    protected const int HKD_DATA_INDEX = 9;

    public ?float $HKD {
        get => $this->getData(self::HKD_DATA_INDEX);
        set => $this->setData(self::HKD_DATA_INDEX, $value);
    }

    // HUF
    public const string HUF = 'HUF';
    protected const string HUF_DATA_NAME = 'HUF';
    protected const int HUF_DATA_INDEX = 10;

    public ?float $HUF {
        get => $this->getData(self::HUF_DATA_INDEX);
        set => $this->setData(self::HUF_DATA_INDEX, $value);
    }

    // IDR
    public const string IDR = 'IDR';
    protected const string IDR_DATA_NAME = 'IDR';
    protected const int IDR_DATA_INDEX = 11;

    public ?int $IDR {
        get => $this->getData(self::IDR_DATA_INDEX);
        set => $this->setData(self::IDR_DATA_INDEX, $value);
    }

    // ILS
    public const string ILS = 'ILS';
    protected const string ILS_DATA_NAME = 'ILS';
    protected const int ILS_DATA_INDEX = 12;

    public ?float $ILS {
        get => $this->getData(self::ILS_DATA_INDEX);
        set => $this->setData(self::ILS_DATA_INDEX, $value);
    }

    // INR
    public const string INR = 'INR';
    protected const string INR_DATA_NAME = 'INR';
    protected const int INR_DATA_INDEX = 13;

    public ?float $INR {
        get => $this->getData(self::INR_DATA_INDEX);
        set => $this->setData(self::INR_DATA_INDEX, $value);
    }

    // ISK
    public const string ISK = 'ISK';
    protected const string ISK_DATA_NAME = 'ISK';
    protected const int ISK_DATA_INDEX = 14;

    public ?float $ISK {
        get => $this->getData(self::ISK_DATA_INDEX);
        set => $this->setData(self::ISK_DATA_INDEX, $value);
    }

    // JPY
    public const string JPY = 'JPY';
    protected const string JPY_DATA_NAME = 'JPY';
    protected const int JPY_DATA_INDEX = 15;

    public ?float $JPY {
        get => $this->getData(self::JPY_DATA_INDEX);
        set => $this->setData(self::JPY_DATA_INDEX, $value);
    }

    // KRW
    public const string KRW = 'KRW';
    protected const string KRW_DATA_NAME = 'KRW';
    protected const int KRW_DATA_INDEX = 16;

    public ?float $KRW {
        get => $this->getData(self::KRW_DATA_INDEX);
        set => $this->setData(self::KRW_DATA_INDEX, $value);
    }

    // MXN
    public const string MXN = 'MXN';
    protected const string MXN_DATA_NAME = 'MXN';
    protected const int MXN_DATA_INDEX = 17;

    public ?float $MXN {
        get => $this->getData(self::MXN_DATA_INDEX);
        set => $this->setData(self::MXN_DATA_INDEX, $value);
    }

    // MYR
    public const string MYR = 'MYR';
    protected const string MYR_DATA_NAME = 'MYR';
    protected const int MYR_DATA_INDEX = 18;

    public ?float $MYR {
        get => $this->getData(self::MYR_DATA_INDEX);
        set => $this->setData(self::MYR_DATA_INDEX, $value);
    }

    // NOK
    public const string NOK = 'NOK';
    protected const string NOK_DATA_NAME = 'NOK';
    protected const int NOK_DATA_INDEX = 19;

    public ?float $NOK {
        get => $this->getData(self::NOK_DATA_INDEX);
        set => $this->setData(self::NOK_DATA_INDEX, $value);
    }

    // NZD
    public const string NZD = 'NZD';
    protected const string NZD_DATA_NAME = 'NZD';
    protected const int NZD_DATA_INDEX = 20;

    public ?float $NZD {
        get => $this->getData(self::NZD_DATA_INDEX);
        set => $this->setData(self::NZD_DATA_INDEX, $value);
    }

    // PHP
    public const string PHP = 'PHP';
    protected const string PHP_DATA_NAME = 'PHP';
    protected const int PHP_DATA_INDEX = 21;

    public ?float $PHP {
        get => $this->getData(self::PHP_DATA_INDEX);
        set => $this->setData(self::PHP_DATA_INDEX, $value);
    }

    // PLN
    public const string PLN = 'PLN';
    protected const string PLN_DATA_NAME = 'PLN';
    protected const int PLN_DATA_INDEX = 22;

    public ?float $PLN {
        get => $this->getData(self::PLN_DATA_INDEX);
        set => $this->setData(self::PLN_DATA_INDEX, $value);
    }

    // RON
    public const string RON = 'RON';
    protected const string RON_DATA_NAME = 'RON';
    protected const int RON_DATA_INDEX = 23;

    public ?float $RON {
        get => $this->getData(self::RON_DATA_INDEX);
        set => $this->setData(self::RON_DATA_INDEX, $value);
    }

    // SEK
    public const string SEK = 'SEK';
    protected const string SEK_DATA_NAME = 'SEK';
    protected const int SEK_DATA_INDEX = 24;

    public ?float $SEK {
        get => $this->getData(self::SEK_DATA_INDEX);
        set => $this->setData(self::SEK_DATA_INDEX, $value);
    }

    // SGD
    public const string SGD = 'SGD';
    protected const string SGD_DATA_NAME = 'SGD';
    protected const int SGD_DATA_INDEX = 25;

    public ?float $SGD {
        get => $this->getData(self::SGD_DATA_INDEX);
        set => $this->setData(self::SGD_DATA_INDEX, $value);
    }

    // THB
    public const string THB = 'THB';
    protected const string THB_DATA_NAME = 'THB';
    protected const int THB_DATA_INDEX = 26;

    public ?float $THB {
        get => $this->getData(self::THB_DATA_INDEX);
        set => $this->setData(self::THB_DATA_INDEX, $value);
    }

    // TRY
    public const string TRY = 'TRY';
    protected const string TRY_DATA_NAME = 'TRY';
    protected const int TRY_DATA_INDEX = 27;

    public ?float $TRY {
        get => $this->getData(self::TRY_DATA_INDEX);
        set => $this->setData(self::TRY_DATA_INDEX, $value);
    }

    // USD
    public const string USD = 'USD';
    protected const string USD_DATA_NAME = 'USD';
    protected const int USD_DATA_INDEX = 28;

    public ?float $USD {
        get => $this->getData(self::USD_DATA_INDEX);
        set => $this->setData(self::USD_DATA_INDEX, $value);
    }

    // ZAR
    public const string ZAR = 'ZAR';
    protected const string ZAR_DATA_NAME = 'ZAR';
    protected const int ZAR_DATA_INDEX = 29;

    public ?float $ZAR {
        get => $this->getData(self::ZAR_DATA_INDEX);
        set => $this->setData(self::ZAR_DATA_INDEX, $value);
    }
}
