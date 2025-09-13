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
        self::AV_FULL_SHOW_INDEX => self::AV_FULL_SHOW,
        self::BCR_INDEX => self::BCR,
        self::CID_INDEX => self::CID,
        self::CTP_INDEX => self::CTP,
        self::OTP_INDEX => self::OTP,
        self::PDT_INDEX => self::PDT,
        self::PTI_INDEX => self::PTI,
        self::SID_INDEX => self::SID,
        self::SRC_INDEX => self::SRC,
        self::TYPE_INDEX => self::TYPE,
    ];

    // av_full_show
    public const string AV_FULL_SHOW = 'av_full_show';
    protected const int AV_FULL_SHOW_INDEX = 0;

    public ?bool $av_full_show {
        get => $this->getData(self::AV_FULL_SHOW_INDEX);
        set => $this->setData(self::AV_FULL_SHOW_INDEX, $value);
    }

    // bcr
    public const string BCR = 'bcr';
    protected const int BCR_INDEX = 1;

    public ?string $bcr {
        get => $this->getData(self::BCR_INDEX);
        set => $this->setData(self::BCR_INDEX, $value);
    }

    // cid
    public const string CID = 'cid';
    protected const int CID_INDEX = 2;

    public ?string $cid {
        get => $this->getData(self::CID_INDEX);
        set => $this->setData(self::CID_INDEX, $value);
    }

    // ctp
    public const string CTP = 'ctp';
    protected const int CTP_INDEX = 3;

    public ?string $ctp {
        get => $this->getData(self::CTP_INDEX);
        set => $this->setData(self::CTP_INDEX, $value);
    }

    // otp
    public const string OTP = 'otp';
    protected const int OTP_INDEX = 4;

    public ?string $otp {
        get => $this->getData(self::OTP_INDEX);
        set => $this->setData(self::OTP_INDEX, $value);
    }

    // pdt
    public const string PDT = 'pdt';
    protected const int PDT_INDEX = 5;

    public ?string $pdt {
        get => $this->getData(self::PDT_INDEX);
        set => $this->setData(self::PDT_INDEX, $value);
    }

    // pti
    public const string PTI = 'pti';
    protected const int PTI_INDEX = 6;

    public ?string $pti {
        get => $this->getData(self::PTI_INDEX);
        set => $this->setData(self::PTI_INDEX, $value);
    }

    // sid
    public const string SID = 'sid';
    protected const int SID_INDEX = 7;

    public ?string $sid {
        get => $this->getData(self::SID_INDEX);
        set => $this->setData(self::SID_INDEX, $value);
    }

    // src
    public const string SRC = 'src';
    protected const int SRC_INDEX = 8;

    public ?string $src {
        get => $this->getData(self::SRC_INDEX);
        set => $this->setData(self::SRC_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    protected const int TYPE_INDEX = 9;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }
}
