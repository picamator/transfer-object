<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/tagesschau-api-bund-dev-v2/definition/ardNews.transfer.yml Definition file path.
 */
final class TrackingTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 10;

    protected const array META_DATA = [
        self::AV_FULL_SHOW_PROP => self::AV_FULL_SHOW_INDEX,
        self::BCR_PROP => self::BCR_INDEX,
        self::CID_PROP => self::CID_INDEX,
        self::CTP_PROP => self::CTP_INDEX,
        self::OTP_PROP => self::OTP_INDEX,
        self::PDT_PROP => self::PDT_INDEX,
        self::PTI_PROP => self::PTI_INDEX,
        self::SID_PROP => self::SID_INDEX,
        self::SRC_PROP => self::SRC_INDEX,
        self::TYPE_PROP => self::TYPE_INDEX,
    ];

    // av_full_show
    public const string AV_FULL_SHOW_PROP = 'av_full_show';
    private const int AV_FULL_SHOW_INDEX = 0;

    public ?bool $av_full_show {
        get => $this->getData(self::AV_FULL_SHOW_INDEX);
        set {
            $this->setData(self::AV_FULL_SHOW_INDEX, $value);
        }
    }

    // bcr
    public const string BCR_PROP = 'bcr';
    private const int BCR_INDEX = 1;

    public ?string $bcr {
        get => $this->getData(self::BCR_INDEX);
        set {
            $this->setData(self::BCR_INDEX, $value);
        }
    }

    // cid
    public const string CID_PROP = 'cid';
    private const int CID_INDEX = 2;

    public ?string $cid {
        get => $this->getData(self::CID_INDEX);
        set {
            $this->setData(self::CID_INDEX, $value);
        }
    }

    // ctp
    public const string CTP_PROP = 'ctp';
    private const int CTP_INDEX = 3;

    public ?string $ctp {
        get => $this->getData(self::CTP_INDEX);
        set {
            $this->setData(self::CTP_INDEX, $value);
        }
    }

    // otp
    public const string OTP_PROP = 'otp';
    private const int OTP_INDEX = 4;

    public ?string $otp {
        get => $this->getData(self::OTP_INDEX);
        set {
            $this->setData(self::OTP_INDEX, $value);
        }
    }

    // pdt
    public const string PDT_PROP = 'pdt';
    private const int PDT_INDEX = 5;

    public ?string $pdt {
        get => $this->getData(self::PDT_INDEX);
        set {
            $this->setData(self::PDT_INDEX, $value);
        }
    }

    // pti
    public const string PTI_PROP = 'pti';
    private const int PTI_INDEX = 6;

    public ?string $pti {
        get => $this->getData(self::PTI_INDEX);
        set {
            $this->setData(self::PTI_INDEX, $value);
        }
    }

    // sid
    public const string SID_PROP = 'sid';
    private const int SID_INDEX = 7;

    public ?string $sid {
        get => $this->getData(self::SID_INDEX);
        set {
            $this->setData(self::SID_INDEX, $value);
        }
    }

    // src
    public const string SRC_PROP = 'src';
    private const int SRC_INDEX = 8;

    public ?string $src {
        get => $this->getData(self::SRC_INDEX);
        set {
            $this->setData(self::SRC_INDEX, $value);
        }
    }

    // type
    public const string TYPE_PROP = 'type';
    private const int TYPE_INDEX = 9;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set {
            $this->setData(self::TYPE_INDEX, $value);
        }
    }
}
