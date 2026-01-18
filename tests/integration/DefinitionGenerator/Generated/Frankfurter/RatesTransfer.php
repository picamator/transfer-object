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
        self::AUD_PROP => self::AUD_INDEX,
        self::BGN_PROP => self::BGN_INDEX,
        self::BRL_PROP => self::BRL_INDEX,
        self::CAD_PROP => self::CAD_INDEX,
        self::CHF_PROP => self::CHF_INDEX,
        self::CNY_PROP => self::CNY_INDEX,
        self::CZK_PROP => self::CZK_INDEX,
        self::DKK_PROP => self::DKK_INDEX,
        self::GBP_PROP => self::GBP_INDEX,
        self::HKD_PROP => self::HKD_INDEX,
        self::HUF_PROP => self::HUF_INDEX,
        self::IDR_PROP => self::IDR_INDEX,
        self::ILS_PROP => self::ILS_INDEX,
        self::INR_PROP => self::INR_INDEX,
        self::ISK_PROP => self::ISK_INDEX,
        self::JPY_PROP => self::JPY_INDEX,
        self::KRW_PROP => self::KRW_INDEX,
        self::MXN_PROP => self::MXN_INDEX,
        self::MYR_PROP => self::MYR_INDEX,
        self::NOK_PROP => self::NOK_INDEX,
        self::NZD_PROP => self::NZD_INDEX,
        self::PHP_PROP => self::PHP_INDEX,
        self::PLN_PROP => self::PLN_INDEX,
        self::RON_PROP => self::RON_INDEX,
        self::SEK_PROP => self::SEK_INDEX,
        self::SGD_PROP => self::SGD_INDEX,
        self::THB_PROP => self::THB_INDEX,
        self::TRY_PROP => self::TRY_INDEX,
        self::USD_PROP => self::USD_INDEX,
        self::ZAR_PROP => self::ZAR_INDEX,
    ];

    // AUD
    public const string AUD_PROP = 'AUD';
    private const int AUD_INDEX = 0;

    public ?float $AUD {
        get => $this->getData(self::AUD_INDEX);
        set {
            $this->setData(self::AUD_INDEX, $value);
        }
    }

    // BGN
    public const string BGN_PROP = 'BGN';
    private const int BGN_INDEX = 1;

    public ?float $BGN {
        get => $this->getData(self::BGN_INDEX);
        set {
            $this->setData(self::BGN_INDEX, $value);
        }
    }

    // BRL
    public const string BRL_PROP = 'BRL';
    private const int BRL_INDEX = 2;

    public ?float $BRL {
        get => $this->getData(self::BRL_INDEX);
        set {
            $this->setData(self::BRL_INDEX, $value);
        }
    }

    // CAD
    public const string CAD_PROP = 'CAD';
    private const int CAD_INDEX = 3;

    public ?float $CAD {
        get => $this->getData(self::CAD_INDEX);
        set {
            $this->setData(self::CAD_INDEX, $value);
        }
    }

    // CHF
    public const string CHF_PROP = 'CHF';
    private const int CHF_INDEX = 4;

    public ?float $CHF {
        get => $this->getData(self::CHF_INDEX);
        set {
            $this->setData(self::CHF_INDEX, $value);
        }
    }

    // CNY
    public const string CNY_PROP = 'CNY';
    private const int CNY_INDEX = 5;

    public ?float $CNY {
        get => $this->getData(self::CNY_INDEX);
        set {
            $this->setData(self::CNY_INDEX, $value);
        }
    }

    // CZK
    public const string CZK_PROP = 'CZK';
    private const int CZK_INDEX = 6;

    public ?float $CZK {
        get => $this->getData(self::CZK_INDEX);
        set {
            $this->setData(self::CZK_INDEX, $value);
        }
    }

    // DKK
    public const string DKK_PROP = 'DKK';
    private const int DKK_INDEX = 7;

    public ?float $DKK {
        get => $this->getData(self::DKK_INDEX);
        set {
            $this->setData(self::DKK_INDEX, $value);
        }
    }

    // GBP
    public const string GBP_PROP = 'GBP';
    private const int GBP_INDEX = 8;

    public ?float $GBP {
        get => $this->getData(self::GBP_INDEX);
        set {
            $this->setData(self::GBP_INDEX, $value);
        }
    }

    // HKD
    public const string HKD_PROP = 'HKD';
    private const int HKD_INDEX = 9;

    public ?float $HKD {
        get => $this->getData(self::HKD_INDEX);
        set {
            $this->setData(self::HKD_INDEX, $value);
        }
    }

    // HUF
    public const string HUF_PROP = 'HUF';
    private const int HUF_INDEX = 10;

    public ?float $HUF {
        get => $this->getData(self::HUF_INDEX);
        set {
            $this->setData(self::HUF_INDEX, $value);
        }
    }

    // IDR
    public const string IDR_PROP = 'IDR';
    private const int IDR_INDEX = 11;

    public ?int $IDR {
        get => $this->getData(self::IDR_INDEX);
        set {
            $this->setData(self::IDR_INDEX, $value);
        }
    }

    // ILS
    public const string ILS_PROP = 'ILS';
    private const int ILS_INDEX = 12;

    public ?float $ILS {
        get => $this->getData(self::ILS_INDEX);
        set {
            $this->setData(self::ILS_INDEX, $value);
        }
    }

    // INR
    public const string INR_PROP = 'INR';
    private const int INR_INDEX = 13;

    public ?float $INR {
        get => $this->getData(self::INR_INDEX);
        set {
            $this->setData(self::INR_INDEX, $value);
        }
    }

    // ISK
    public const string ISK_PROP = 'ISK';
    private const int ISK_INDEX = 14;

    public ?float $ISK {
        get => $this->getData(self::ISK_INDEX);
        set {
            $this->setData(self::ISK_INDEX, $value);
        }
    }

    // JPY
    public const string JPY_PROP = 'JPY';
    private const int JPY_INDEX = 15;

    public ?float $JPY {
        get => $this->getData(self::JPY_INDEX);
        set {
            $this->setData(self::JPY_INDEX, $value);
        }
    }

    // KRW
    public const string KRW_PROP = 'KRW';
    private const int KRW_INDEX = 16;

    public ?float $KRW {
        get => $this->getData(self::KRW_INDEX);
        set {
            $this->setData(self::KRW_INDEX, $value);
        }
    }

    // MXN
    public const string MXN_PROP = 'MXN';
    private const int MXN_INDEX = 17;

    public ?float $MXN {
        get => $this->getData(self::MXN_INDEX);
        set {
            $this->setData(self::MXN_INDEX, $value);
        }
    }

    // MYR
    public const string MYR_PROP = 'MYR';
    private const int MYR_INDEX = 18;

    public ?float $MYR {
        get => $this->getData(self::MYR_INDEX);
        set {
            $this->setData(self::MYR_INDEX, $value);
        }
    }

    // NOK
    public const string NOK_PROP = 'NOK';
    private const int NOK_INDEX = 19;

    public ?float $NOK {
        get => $this->getData(self::NOK_INDEX);
        set {
            $this->setData(self::NOK_INDEX, $value);
        }
    }

    // NZD
    public const string NZD_PROP = 'NZD';
    private const int NZD_INDEX = 20;

    public ?float $NZD {
        get => $this->getData(self::NZD_INDEX);
        set {
            $this->setData(self::NZD_INDEX, $value);
        }
    }

    // PHP
    public const string PHP_PROP = 'PHP';
    private const int PHP_INDEX = 21;

    public ?float $PHP {
        get => $this->getData(self::PHP_INDEX);
        set {
            $this->setData(self::PHP_INDEX, $value);
        }
    }

    // PLN
    public const string PLN_PROP = 'PLN';
    private const int PLN_INDEX = 22;

    public ?float $PLN {
        get => $this->getData(self::PLN_INDEX);
        set {
            $this->setData(self::PLN_INDEX, $value);
        }
    }

    // RON
    public const string RON_PROP = 'RON';
    private const int RON_INDEX = 23;

    public ?float $RON {
        get => $this->getData(self::RON_INDEX);
        set {
            $this->setData(self::RON_INDEX, $value);
        }
    }

    // SEK
    public const string SEK_PROP = 'SEK';
    private const int SEK_INDEX = 24;

    public ?float $SEK {
        get => $this->getData(self::SEK_INDEX);
        set {
            $this->setData(self::SEK_INDEX, $value);
        }
    }

    // SGD
    public const string SGD_PROP = 'SGD';
    private const int SGD_INDEX = 25;

    public ?float $SGD {
        get => $this->getData(self::SGD_INDEX);
        set {
            $this->setData(self::SGD_INDEX, $value);
        }
    }

    // THB
    public const string THB_PROP = 'THB';
    private const int THB_INDEX = 26;

    public ?float $THB {
        get => $this->getData(self::THB_INDEX);
        set {
            $this->setData(self::THB_INDEX, $value);
        }
    }

    // TRY
    public const string TRY_PROP = 'TRY';
    private const int TRY_INDEX = 27;

    public ?float $TRY {
        get => $this->getData(self::TRY_INDEX);
        set {
            $this->setData(self::TRY_INDEX, $value);
        }
    }

    // USD
    public const string USD_PROP = 'USD';
    private const int USD_INDEX = 28;

    public ?float $USD {
        get => $this->getData(self::USD_INDEX);
        set {
            $this->setData(self::USD_INDEX, $value);
        }
    }

    // ZAR
    public const string ZAR_PROP = 'ZAR';
    private const int ZAR_INDEX = 29;

    public ?float $ZAR {
        get => $this->getData(self::ZAR_INDEX);
        set {
            $this->setData(self::ZAR_INDEX, $value);
        }
    }
}
