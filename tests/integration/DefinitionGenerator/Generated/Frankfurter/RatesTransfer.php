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
        self::AUD => self::AUD_INDEX,
        self::BGN => self::BGN_INDEX,
        self::BRL => self::BRL_INDEX,
        self::CAD => self::CAD_INDEX,
        self::CHF => self::CHF_INDEX,
        self::CNY => self::CNY_INDEX,
        self::CZK => self::CZK_INDEX,
        self::DKK => self::DKK_INDEX,
        self::GBP => self::GBP_INDEX,
        self::HKD => self::HKD_INDEX,
        self::HUF => self::HUF_INDEX,
        self::IDR => self::IDR_INDEX,
        self::ILS => self::ILS_INDEX,
        self::INR => self::INR_INDEX,
        self::ISK => self::ISK_INDEX,
        self::JPY => self::JPY_INDEX,
        self::KRW => self::KRW_INDEX,
        self::MXN => self::MXN_INDEX,
        self::MYR => self::MYR_INDEX,
        self::NOK => self::NOK_INDEX,
        self::NZD => self::NZD_INDEX,
        self::PHP => self::PHP_INDEX,
        self::PLN => self::PLN_INDEX,
        self::RON => self::RON_INDEX,
        self::SEK => self::SEK_INDEX,
        self::SGD => self::SGD_INDEX,
        self::THB => self::THB_INDEX,
        self::TRY => self::TRY_INDEX,
        self::USD => self::USD_INDEX,
        self::ZAR => self::ZAR_INDEX,
    ];

    // AUD
    public const string AUD = 'AUD';
    private const int AUD_INDEX = 0;

    public ?float $AUD {
        get => $this->getData(self::AUD_INDEX);
        set => $this->setData(self::AUD_INDEX, $value);
    }

    // BGN
    public const string BGN = 'BGN';
    private const int BGN_INDEX = 1;

    public ?float $BGN {
        get => $this->getData(self::BGN_INDEX);
        set => $this->setData(self::BGN_INDEX, $value);
    }

    // BRL
    public const string BRL = 'BRL';
    private const int BRL_INDEX = 2;

    public ?float $BRL {
        get => $this->getData(self::BRL_INDEX);
        set => $this->setData(self::BRL_INDEX, $value);
    }

    // CAD
    public const string CAD = 'CAD';
    private const int CAD_INDEX = 3;

    public ?float $CAD {
        get => $this->getData(self::CAD_INDEX);
        set => $this->setData(self::CAD_INDEX, $value);
    }

    // CHF
    public const string CHF = 'CHF';
    private const int CHF_INDEX = 4;

    public ?float $CHF {
        get => $this->getData(self::CHF_INDEX);
        set => $this->setData(self::CHF_INDEX, $value);
    }

    // CNY
    public const string CNY = 'CNY';
    private const int CNY_INDEX = 5;

    public ?float $CNY {
        get => $this->getData(self::CNY_INDEX);
        set => $this->setData(self::CNY_INDEX, $value);
    }

    // CZK
    public const string CZK = 'CZK';
    private const int CZK_INDEX = 6;

    public ?float $CZK {
        get => $this->getData(self::CZK_INDEX);
        set => $this->setData(self::CZK_INDEX, $value);
    }

    // DKK
    public const string DKK = 'DKK';
    private const int DKK_INDEX = 7;

    public ?float $DKK {
        get => $this->getData(self::DKK_INDEX);
        set => $this->setData(self::DKK_INDEX, $value);
    }

    // GBP
    public const string GBP = 'GBP';
    private const int GBP_INDEX = 8;

    public ?float $GBP {
        get => $this->getData(self::GBP_INDEX);
        set => $this->setData(self::GBP_INDEX, $value);
    }

    // HKD
    public const string HKD = 'HKD';
    private const int HKD_INDEX = 9;

    public ?float $HKD {
        get => $this->getData(self::HKD_INDEX);
        set => $this->setData(self::HKD_INDEX, $value);
    }

    // HUF
    public const string HUF = 'HUF';
    private const int HUF_INDEX = 10;

    public ?float $HUF {
        get => $this->getData(self::HUF_INDEX);
        set => $this->setData(self::HUF_INDEX, $value);
    }

    // IDR
    public const string IDR = 'IDR';
    private const int IDR_INDEX = 11;

    public ?int $IDR {
        get => $this->getData(self::IDR_INDEX);
        set => $this->setData(self::IDR_INDEX, $value);
    }

    // ILS
    public const string ILS = 'ILS';
    private const int ILS_INDEX = 12;

    public ?float $ILS {
        get => $this->getData(self::ILS_INDEX);
        set => $this->setData(self::ILS_INDEX, $value);
    }

    // INR
    public const string INR = 'INR';
    private const int INR_INDEX = 13;

    public ?float $INR {
        get => $this->getData(self::INR_INDEX);
        set => $this->setData(self::INR_INDEX, $value);
    }

    // ISK
    public const string ISK = 'ISK';
    private const int ISK_INDEX = 14;

    public ?float $ISK {
        get => $this->getData(self::ISK_INDEX);
        set => $this->setData(self::ISK_INDEX, $value);
    }

    // JPY
    public const string JPY = 'JPY';
    private const int JPY_INDEX = 15;

    public ?float $JPY {
        get => $this->getData(self::JPY_INDEX);
        set => $this->setData(self::JPY_INDEX, $value);
    }

    // KRW
    public const string KRW = 'KRW';
    private const int KRW_INDEX = 16;

    public ?float $KRW {
        get => $this->getData(self::KRW_INDEX);
        set => $this->setData(self::KRW_INDEX, $value);
    }

    // MXN
    public const string MXN = 'MXN';
    private const int MXN_INDEX = 17;

    public ?float $MXN {
        get => $this->getData(self::MXN_INDEX);
        set => $this->setData(self::MXN_INDEX, $value);
    }

    // MYR
    public const string MYR = 'MYR';
    private const int MYR_INDEX = 18;

    public ?float $MYR {
        get => $this->getData(self::MYR_INDEX);
        set => $this->setData(self::MYR_INDEX, $value);
    }

    // NOK
    public const string NOK = 'NOK';
    private const int NOK_INDEX = 19;

    public ?float $NOK {
        get => $this->getData(self::NOK_INDEX);
        set => $this->setData(self::NOK_INDEX, $value);
    }

    // NZD
    public const string NZD = 'NZD';
    private const int NZD_INDEX = 20;

    public ?float $NZD {
        get => $this->getData(self::NZD_INDEX);
        set => $this->setData(self::NZD_INDEX, $value);
    }

    // PHP
    public const string PHP = 'PHP';
    private const int PHP_INDEX = 21;

    public ?float $PHP {
        get => $this->getData(self::PHP_INDEX);
        set => $this->setData(self::PHP_INDEX, $value);
    }

    // PLN
    public const string PLN = 'PLN';
    private const int PLN_INDEX = 22;

    public ?float $PLN {
        get => $this->getData(self::PLN_INDEX);
        set => $this->setData(self::PLN_INDEX, $value);
    }

    // RON
    public const string RON = 'RON';
    private const int RON_INDEX = 23;

    public ?float $RON {
        get => $this->getData(self::RON_INDEX);
        set => $this->setData(self::RON_INDEX, $value);
    }

    // SEK
    public const string SEK = 'SEK';
    private const int SEK_INDEX = 24;

    public ?float $SEK {
        get => $this->getData(self::SEK_INDEX);
        set => $this->setData(self::SEK_INDEX, $value);
    }

    // SGD
    public const string SGD = 'SGD';
    private const int SGD_INDEX = 25;

    public ?float $SGD {
        get => $this->getData(self::SGD_INDEX);
        set => $this->setData(self::SGD_INDEX, $value);
    }

    // THB
    public const string THB = 'THB';
    private const int THB_INDEX = 26;

    public ?float $THB {
        get => $this->getData(self::THB_INDEX);
        set => $this->setData(self::THB_INDEX, $value);
    }

    // TRY
    public const string TRY = 'TRY';
    private const int TRY_INDEX = 27;

    public ?float $TRY {
        get => $this->getData(self::TRY_INDEX);
        set => $this->setData(self::TRY_INDEX, $value);
    }

    // USD
    public const string USD = 'USD';
    private const int USD_INDEX = 28;

    public ?float $USD {
        get => $this->getData(self::USD_INDEX);
        set => $this->setData(self::USD_INDEX, $value);
    }

    // ZAR
    public const string ZAR = 'ZAR';
    private const int ZAR_INDEX = 29;

    public ?float $ZAR {
        get => $this->getData(self::ZAR_INDEX);
        set => $this->setData(self::ZAR_INDEX, $value);
    }
}
