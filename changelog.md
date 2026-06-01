# Changelog

All notable changes to `AmeriaBankVPOS` will be documented in this file.

## Unreleased

### Added
- Optional `Type` option on `pay()` to open a specific payment page directly via the redirect URL `type` parameter (`PAYMENT_TYPE_APPLE_PAY` = 13, `PAYMENT_TYPE_CARD` = 5). Omitted or invalid values fall back to device auto-detection. Fully backward-compatible; `InitPayment` is unchanged.

## Version 1.0

### Added
- Everything
