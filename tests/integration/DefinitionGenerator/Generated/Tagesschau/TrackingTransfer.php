<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class TrackingTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 10;

    protected const array META_DATA = [
        self::AV_FULL_SHOW => self::AV_FULL_SHOW_DATA_NAME,
        self::BCR => self::BCR_DATA_NAME,
        self::CID => self::CID_DATA_NAME,
        self::CTP => self::CTP_DATA_NAME,
        self::OTP => self::OTP_DATA_NAME,
        self::PDT => self::PDT_DATA_NAME,
        self::PTI => self::PTI_DATA_NAME,
        self::SID => self::SID_DATA_NAME,
        self::SRC => self::SRC_DATA_NAME,
        self::TYPE => self::TYPE_DATA_NAME,
    ];

    // av_full_show
    public const string AV_FULL_SHOW = 'av_full_show';
    protected const string AV_FULL_SHOW_DATA_NAME = 'AV_FULL_SHOW';
    protected const int AV_FULL_SHOW_DATA_INDEX = 0;

    public ?bool $av_full_show {
        get => $this->getData(self::AV_FULL_SHOW_DATA_INDEX);
        set => $this->setData(self::AV_FULL_SHOW_DATA_INDEX, $value);
    }

    // bcr
    public const string BCR = 'bcr';
    protected const string BCR_DATA_NAME = 'BCR';
    protected const int BCR_DATA_INDEX = 1;

    public ?string $bcr {
        get => $this->getData(self::BCR_DATA_INDEX);
        set => $this->setData(self::BCR_DATA_INDEX, $value);
    }

    // cid
    public const string CID = 'cid';
    protected const string CID_DATA_NAME = 'CID';
    protected const int CID_DATA_INDEX = 2;

    public ?string $cid {
        get => $this->getData(self::CID_DATA_INDEX);
        set => $this->setData(self::CID_DATA_INDEX, $value);
    }

    // ctp
    public const string CTP = 'ctp';
    protected const string CTP_DATA_NAME = 'CTP';
    protected const int CTP_DATA_INDEX = 3;

    public ?string $ctp {
        get => $this->getData(self::CTP_DATA_INDEX);
        set => $this->setData(self::CTP_DATA_INDEX, $value);
    }

    // otp
    public const string OTP = 'otp';
    protected const string OTP_DATA_NAME = 'OTP';
    protected const int OTP_DATA_INDEX = 4;

    public ?string $otp {
        get => $this->getData(self::OTP_DATA_INDEX);
        set => $this->setData(self::OTP_DATA_INDEX, $value);
    }

    // pdt
    public const string PDT = 'pdt';
    protected const string PDT_DATA_NAME = 'PDT';
    protected const int PDT_DATA_INDEX = 5;

    public ?string $pdt {
        get => $this->getData(self::PDT_DATA_INDEX);
        set => $this->setData(self::PDT_DATA_INDEX, $value);
    }

    // pti
    public const string PTI = 'pti';
    protected const string PTI_DATA_NAME = 'PTI';
    protected const int PTI_DATA_INDEX = 6;

    public ?string $pti {
        get => $this->getData(self::PTI_DATA_INDEX);
        set => $this->setData(self::PTI_DATA_INDEX, $value);
    }

    // sid
    public const string SID = 'sid';
    protected const string SID_DATA_NAME = 'SID';
    protected const int SID_DATA_INDEX = 7;

    public ?string $sid {
        get => $this->getData(self::SID_DATA_INDEX);
        set => $this->setData(self::SID_DATA_INDEX, $value);
    }

    // src
    public const string SRC = 'src';
    protected const string SRC_DATA_NAME = 'SRC';
    protected const int SRC_DATA_INDEX = 8;

    public ?string $src {
        get => $this->getData(self::SRC_DATA_INDEX);
        set => $this->setData(self::SRC_DATA_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    protected const string TYPE_DATA_NAME = 'TYPE';
    protected const int TYPE_DATA_INDEX = 9;

    public ?string $type {
        get => $this->getData(self::TYPE_DATA_INDEX);
        set => $this->setData(self::TYPE_DATA_INDEX, $value);
    }
}
