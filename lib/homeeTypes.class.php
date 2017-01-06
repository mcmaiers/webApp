<?php

/**
 * @author      Frank Herrmann <frank@codeking.de>
 * @copyright   2016
 * @link        https://codeking.de/smarthome/homee.api.zip
 */
class HomeeTypes
{
    /** Users */
    protected $users_role = array(
        1 => 'Service',
        2 => 'Admin',
        3 => 'Standard',
        4 => 'Limited'
    );

    protected $users_type = array(
        0 => 'None',
        1 => 'Local',
        2 => 'MyHager'
    );

    /** Notifications */
    protected $notification_node = array(
        1 => 'BatteryLow',
        2 => 'BadLinkQuality',
        3 => 'IsMissing'
    );

    protected $notification_warning = array(
        1 => 'SmokeDetected',
        2 => 'WaterDetected'
    );

    protected $notification_update = array(
        1 => 'Available',
        2 => 'InProgrss',
        3 => 'Finished',
        4 => 'Issue'
    );

    protected $notification_cube = array(
        1 => 'Added',
        2 => 'Removed',
        3 => 'IsMissing'
    );

    /** Devices */
    protected $devices_type = array(
        0 => 'None',
        1 => 'Phone',
        2 => 'Tablet',
        3 => 'Desktop',
        4 => 'Browser'
    );

    protected $devices_os = array(
        0 => 'None',
        1 => 'iOS',
        2 => 'Android',
        3 => 'Windows',
        4 => 'WindowsPhone',
        5 => 'Linux',
        6 => 'MacOs'
    );

    /** Nodes */
    protected $nodes_profile = array(
        0 => 'None',
        1 => 'Homee Cube',

        // Generic (10-999)
        10 => 'OnOffPlug',
        11 => 'DimmableMeteringSwitch',
        12 => 'MeteringSwitch',
        13 => 'MeteringPlug',
        14 => 'DimmablePlug',
        15 => 'DimmableSwitch',
        16 => 'OnOffSwitch',
        18 => 'DoubleOnOffSwitch',
        19 => 'DimmableMeteringPlug',
        20 => 'OneButtonRemote',
        21 => 'BinaryInput',
        22 => 'DimmableColorMeteringSwitch',
        23 => 'DoubleBinaryInput',
        24 => 'TwoButtonRemote',
        25 => 'ThreeButtonRemote',
        26 => 'FourButtonRemote',
        27 => 'AlarmSensor',

        // Lighting (1000 - 1999
        1000 => 'BrightnessSensor',
        1001 => 'DimmableColorLight',
        1002 => 'DimmableExtendedColorLight',
        1003 => 'DimmableColorTemperatureLight',

        // Closures (2000 - 2999)
        2000 => 'OpenCloseSensor',
        2001 => 'WindowHandle',
        2002 => 'ShutterPositionSwitch',
        2003 => 'OpenCloseAndTemperatureSensor',
        2004 => 'ElectricMotorMeteringSwitch',
        2005 => '??',

        // HVAC (3000 - 3999)
        3001 => 'TemperatureAndHumiditySensor',
        3002 => 'CO2Sensor',
        3003 => 'RoomThermostat',
        3004 => 'RoomThermostatWithHumiditySensor',
        3005 => 'BinaryInputWithTemperatureSensor',
        3006 => 'RadiatorThermostat',
        3009 => 'TemperatureSensor',
        3010 => 'HumiditySensor',
        3011 => 'WaterValve',
        3012 => 'WaterMeter',
        3013 => 'WeatherStation',
        3014 => 'NetatmoMainModule',
        3015 => 'NetatmoOutdoorModule',
        3016 => 'NetatmoIndoorModule',
        3017 => 'NetatmoRainModule',
        3018 => 'TwoChannelCosiTherm',
        3019 => 'SixChannelCosiTherm',
        3020 => 'NestThermostatWithCoolinng',
        3021 => 'NestThermostatWithHeating',
        3022 => 'NestThermostatWithHeatingAndCooling',
        3023 => 'NetatmoWindModule',

        // Alarm (4000 - 4999)
        4010 => 'MotionDetectorWithTemperatureBrightnessAndHumiditySensor',
        4011 => 'MotionDetector',
        4012 => 'SmokeDetector',
        4013 => 'FloodDetector',
        4014 => 'PresenceDetector',
        4015 => 'MotionDetectorWithTemperatureAndBrightnessSensor',
        4016 => 'SmokeDetectorWithTemperatureSensor',
        4017 => 'FloodDetectorWithTemperatureSensor',
        4018 => 'WatchDogDevice',
        4019 => 'LAG',
        4020 => 'OWU',
        4021 => 'Eurovac',
        4022 => 'OWWG3',
        4023 => 'Europress',
        4024 => 'MinimumDetector',
        4025 => 'MaximumDetector',
        4026 => 'SmokeDetectorAndCODetector',

        // Hager (5000 - 5999)
        5000 => 'InovaAlarmSystem',
        5001 => 'InovaDetector',
        5002 => 'InovaSiren',
        5003 => 'InovaCommand',
        5004 => 'InovaTransmitter',
        5005 => 'InovaReciever',
        5006 => 'InovaKoala',
        5007 => 'InovaInternalTransmitter',
        5008 => 'InovaControlPanel',
        5009 => 'InovaInputOutputExtension',
        5010 => 'InovaMotionDetectorWithVOD',
        5011 => 'InovaMotionDetector',

        // Plants (6000 - 6999)
        6000 => 'KoubachiPlantSensor'
    );

    protected $nodes_protocol = array(
        0 => 'None',
        1 => 'ZWave',
        2 => 'ZigBee',
        3 => 'EnOcean',
        4 => 'WMBus',
        5 => 'Homematic',
        6 => 'KNXRF',
        7 => 'Inova',
        8 => 'HTTPAVM',
        9 => 'HTTPNetatmo',
        10 => 'HTTPKoubachi',
        11 => 'HTTPNest',
        12 => 'IOCube',
        100 => 'All'
    );

    protected $nodes_state = array(
        0 => 'None',
        1 => 'Available',
        2 => 'Unavailable',
        3 => 'UpdateInProgress',
        4 => 'WaitingForAttributes',
        5 => 'Initializing',
        6 => 'UserInteractionRequired',
        7 => 'PasswordRequired',
        8 => 'HostUnavailable',
        9 => 'DeleteInProgress',
        10 => 'CosiConnected'
    );

    /** Attributes */
    protected $attributes_type = array(
        0 => 'None',
        1 => 'OnOff',
        2 => 'DimmingLevel',
        3 => 'CurrentEnergyUse',
        4 => 'AccumulatedEnergyUse',
        5 => 'Temperature',
        6 => 'TargetTemperature',
        7 => 'RelativeHumidity',
        8 => 'BatteryLevel',
        9 => 'StatusLED',
        10 => 'WindowPosition',
        11 => 'Brightness',
        12 => 'FloodAlarm',
        13 => 'Siren',
        14 => 'OpenClose',
        15 => 'Position',
        16 => 'SmokeAlarm',
        17 => 'BlackoutAlarm',
        18 => 'CurrentValvePosition',
        19 => 'BinaryInput',
        20 => 'CO2Level',
        21 => 'Update',
        22 => 'BatteryState',
        23 => 'Color',
        24 => 'Saturation',
        25 => 'MotionAlarm',
        26 => 'MotionSensitivity',
        27 => 'MotionInsensitivity',
        28 => 'MotionAlarmCancelationDelay',
        29 => 'WakeUpInterval',
        30 => 'TamperAlarm',
        31 => 'AcousticSignal',
        32 => 'BinaryOutput',
        33 => 'LinkQuality',
        34 => 'InovaAlarmSystemState',
        35 => 'InovaAlarmGroupState',
        36 => 'InovaAlarmIntrusionState',
        37 => 'InovaAlarmErrorState',
        38 => 'InovaAlarmDoorState',
        39 => 'InovaAlarmExternalSensor',
        40 => 'ButtonState',
        41 => 'Hue',
        42 => 'ColorTemperature',
        43 => 'HardwareRevision',
        44 => 'FirmwareRevision',
        45 => 'SoftwareRevision',
        46 => 'LEDState',
        47 => 'LEDStateWhenOn',
        48 => 'LEDStateWhenOff',
        49 => 'OpenCasingAlarm',
        50 => 'AcousticAndVisualSignals',
        51 => 'TemperatureMeasurementInterval',
        52 => 'HighTemperatureAlarm',
        53 => 'HighTemperatureAlarmTreshold',
        54 => 'LowTemperatureAlarm',
        55 => 'LowTemperatureAlarmTreshold',
        56 => 'TamperSensitivity',
        57 => 'TamperAlarmCancelationDelay',
        58 => 'BrightnessReportInterval',
        59 => 'TemperatureReportInterval',
        60 => 'MotionAlarmIndicationMode',
        61 => 'LEDBrightness',
        62 => 'TamperAlarmIndicationMode',
        63 => 'SwitchType',
        64 => 'TemperatureOffset',
        65 => 'AccumulatedWaterUse',
        66 => 'AccumulatedWaterUseLastMonth',
        67 => 'CurrentDate',
        68 => 'LeakAlarm',
        69 => 'BatteryLowAlarm',
        70 => 'MalfunctionAlarm',
        71 => 'LinkQualityAlarm',
        72 => 'Mode',
        73 => 'CurrentState',
        74 => 'TargetState',
        75 => 'Calibration',
        76 => 'PresenceAlarm',
        77 => 'MinimumAlarm',
        78 => 'MaximumAlarm',
        79 => 'OilAlarm',
        80 => 'WaterAlarm',
        81 => 'InovaAlarmInhibition',
        82 => 'InovaAlarmEjection',
        83 => 'InovaAlarmCommercialRef',
        84 => 'InovaAlarmSerialNumber',
        85 => 'RadiatorThermostatSummerMode',
        86 => 'InovaAlarmOperationMode',
        87 => 'AutomaticMode',
        88 => 'PollingInterval',
        89 => 'FeedTemperature',
        90 => 'DisplayOrientation',
        91 => 'ManualOperation',
        92 => 'DeviceTemperature',
        93 => 'Sonometer',
        94 => 'AirPressure',
        95 => 'OutdoorRelativeHumidity',
        96 => 'IndoorRelativeHumidity',
        97 => 'OutdoorTemperature',
        98 => 'IndoorTemperature',
        99 => 'InovaAlarmAntimask',
        100 => 'InovaAlarmBackupSupply',
        101 => 'RainFall',
        102 => 'LastUpdateOnServer',
        103 => 'InovaAlarmGeneralHomeCommand',
        104 => 'InovaAlarmAlert',
        105 => 'InovaAlarmSilentAlert',
        106 => 'InovaAlarmPreAlarm',
        107 => 'InovaAlarmDeterrenceAlarm',
        108 => 'InovaAlarmWarning',
        109 => 'InovaAlarmFireAlarm',
        110 => 'UpTime',
        111 => 'DownTime',
        112 => 'ShutterBlindMode',
        113 => 'ShutterSlatPosition',
        114 => 'ShutterSlatTime',
        115 => 'RestartDevice',
        116 => 'SoilMoisture',
        117 => 'WaterPlantAlarm',
        118 => 'MistPlantAlarm',
        119 => 'FertilizePlantAlarm',
        120 => 'CoolPlantAlarm',
        121 => 'HeatPlantAlarm',
        122 => 'PutPlantIntoLightAlarm',
        123 => 'PutPlantIntoShadeAlarm',
        124 => 'ColorMode',
        125 => 'TargetTemperatureLow',
        126 => 'TargetTemperatureHigh',
        127 => 'HVACMode',
        128 => 'Away',
        129 => 'HVACState',
        130 => 'HasLeaf',
        131 => 'SetEnergyConsumption',
        132 => 'COAlarm',
        133 => 'RestoreLastKnownState',
        134 => 'LastImageReceived',
        135 => 'UpDown',
        136 => 'RequestVOD',
        137 => 'InovaDetectorHistory',
        138 => 'SurgeAlarm',
        139 => 'LoadAlarm',
        140 => 'OverloadAlarm',
        141 => 'VolatageDropAlarm',
        142 => 'ShutterOrientation',
        143 => 'OverCurrentAlarm',
        144 => 'SirenMode',
        145 => 'AlarmAutoStopTime',
        146 => 'WindSpeed',
        147 => 'WindDirection',
        205 => 'HomeeMode'
    );

    protected $attributes_state = array(
        0 => 'None',
        1 => 'Normal',
        2 => 'WaitingForWakeup',
        3 => 'WaitingForValue',
        4 => 'WaitingForAcknowledge',
        5 => 'Inactive'
    );

    protected $attributes_changed_by = array(
        0 => 'ByNone',
        1 => 'ByItself',
        2 => 'ByUser',
        3 => 'ByHomeegram'
    );

    protected $attributes_based_on = array(
        0 => 'OnEvents',
        1 => 'OnInterval',
        2 => 'OnPolling'
    );

    /** Groups */
    protected $groups_state = array(
        0 => 'None',
        1 => 'Normal',
        2 => 'Executing'
    );

    protected $groups_category = array(
        0 => 'None'
    );

    /** Triggers */
    protected $triggers = array(
        0 => 'None',
        1 => 'Time',
        2 => 'Attribute',
        3 => 'Switch'
    );

    protected $attribute_triggers_operator = array(
        0 => 'None',
        1 => 'RiseAbove',
        2 => 'FallBelow',
        3 => 'BecomeEqual',
        4 => 'AnyChangeGreaterThan'
    );

    /** Homeegram Conditions */
    protected $homegram_condition = array(
        0 => 'None',
        1 => 'Time',
        2 => 'Attribute'
    );

    protected $attribute_conditions_operator = array(
        0 => 'None',
        1 => 'Equal',
        2 => 'LessEqual',
        3 => 'GreaterEqual',
        4 => 'LessThan',
        5 => 'GreaterThan'
    );

    protected $attribute_conditions_check_moment = array(
        0 => 'None',
        1 => 'Start',
        2 => 'End',
        3 => 'StartAndEnd'
    );

    /** Homeegram Actions */
    protected $actions_type = array(
        0 => 'None',
        1 => 'Attribute',
        2 => 'TTS',
        3 => 'Notification',
        4 => 'Group'
    );

    protected $notification_actions_style = array(
        0 => 'None',
        1 => 'Push',
        2 => 'SMS',
        3 => 'Email'
    );

    /** Settings */
    protected $settings_wlan_mode = array(
        0 => 'None',
        1 => 'Hotspot',
        2 => 'Client',
        3 => 'Bridge'
    );

    public $cubes_type = array(
        0 => 'None',
        1 => 'PurpleZWave',
        2 => 'OrangeZigBee',
        3 => 'CyanEnocean',
        4 => 'YellowWMbus',
        5 => 'Inova',
        6 => 'KNXRF',
        7 => 'Homematic',
        8 => 'IOCube'
    );

    /** Warnings */
    protected $warning_code = array(
        // Cube
        100 => 'CubeAdded',
        101 => 'CubeRemoved',
        102 => 'CubeIsMissing',
        103 => 'CubeInLearnMode',
        104 => 'CubeLearnModeStarted',
        105 => 'CubeLearnModeSuccessful',
        106 => 'CubeLearnModeTimeout',
        107 => 'CubeLearnModeNodeAlreadyAdded',
        108 => 'CubeLearnModeFailed',
        109 => 'CubeInRemoveMode',
        110 => 'CubeRemoveModeStarted',
        111 => 'CubeRemoveModeSuccessful',
        112 => 'CubeRemoveModeTimeout',
        113 => 'CubeRemoveModeNodeAlreadyDeleted',
        114 => 'CubeRemoveModeFailed',
        115 => 'CubeScannedNodes',
        116 => 'CubeUpdateInProgess',
        117 => 'CubeUpdateStarted',
        118 => 'CubeUpdateEnded',
        119 => 'CubeUpdateFailed',
        120 => 'CubeUserInteractionRequired',
        121 => 'CubeRemoveModeCanceled',
        122 => 'CubeLearnModeCanceled',
        123 => 'CubeAuthorizationRequired',

        // Node
        200 => 'NodeBadLinkQuality',
        201 => 'NodeIsMissing',
        202 => 'NodeWaterDetected',
        203 => 'NodeSmokeDetected',
        204 => 'NodeBatteryLow',
        205 => 'NodeLocked',
        206 => 'NodeNotCompatible',
        207 => 'NodeResetSuccessful',
        208 => 'NodeResetStarted',
        209 => 'NodeResetFailed',
        210 => 'NodeResetTimeout',
        211 => 'NodeWrongHVACMode',
        212 => 'NodeRangeError',
        213 => 'NodeBlocked',
        214 => 'NodeWrongAwayMode',
        215 => 'NodeResetCanceled',

        // Settings
        300 => 'SettingRemoteAccessActivated',
        301 => 'SettingRemoteAccessDeactivated',
        302 => 'SettingOnline',
        303 => 'SettingOffline',
        304 => 'SettingNetworkUninitialized',
        305 => 'SettingNetworkInitializing',
        306 => 'SettingNetworkInitialized',

        // Update
        400 => 'UpdateAvailable',
        401 => 'UpdateDownloading',
        402 => 'UpdateInstalling',
        403 => 'UpdateInProgress',
        404 => 'UpdateSuccessful',
        405 => 'UpdateConnectionFailed',
        406 => 'UpdateDownloadFailed',
        407 => 'UpdateInstallationFailed',
        408 => 'UpdatePreparing',

        // Access
        500 => 'PermissionDenied',
        501 => 'TeachInForbidden',
        502 => 'PermissionGranted',
        503 => 'VideoCodeWrong',

        // Device
        600 => 'DeviceRemoved',
        601 => 'DeviceAdded',

        // User
        700 => 'UserRemoved',
        701 => 'AllUsersRemoved',
        702 => 'UserPasswordChangeRequired',
        703 => 'UserPasswordChangeFailed',
        704 => 'UserPasswordChangeSuccessful',

        // Inova
        800 => 'InovaIntrusionDetected',
        801 => 'InovaError',
        802 => 'InovaDetectorEjected',
        803 => 'InovaDoorOpen',
        804 => 'InovaWrongOperationMode',
        805 => 'InovaCommandTimeout',
        806 => 'InovaCommandForbidden',
        807 => 'InovaArmingBlocked'
    );

    /**
     * Mapping: maps node profiles to values (defaults to 'current_value')
     */
    protected $nodes_profile_value_mapping = array(
        'None' => '',
        'Homee Cube' => '',

        // Generic (10-999)
        'OnOffPlug' => 'on_off',
        'DimmableMeteringSwitch' => 'dimming_level',
        'MeteringSwitch' => 'on_off',
        'MeteringPlug' => 'on_off',
        'DimmablePlug' => 'on_off',
        'DimmableSwitch' => '',
        'OnOffSwitch' => 'on_off',
        'DoubleOnOffSwitch' => '',
        'DimmableMeteringPlug' => 'on_off',
        'OneButtonRemote' => 'button_state',
        'BinaryInput' => '',
        'DimmableColorMeteringSwitch' => '',
        'DoubleBinaryInput' => '',
        'TwoButtonRemote' => 'button_state',
        'ThreeButtonRemote' => 'button_state',
        'FourButtonRemote' => 'button_state',
        'AlarmSensor' => '',

        // Lighting (1000 - 1999
        'BrightnessSensor' => '',
        'DimmableColorLight' => '',
        'DimmableExtendedColorLight' => '',
        'DimmableColorTemperatureLight' => '',

        // Closures (2000 - 2999)
        'OpenCloseSensor' => 'open_close',
        'WindowHandle' => 'open_close',
        'ShutterPositionSwitch' => 'open_close',
        'OpenCloseAndTemperatureSensor' => 'open_close',
        'ElectricMotorMeteringSwitch' => 'open_close',
        '??' => '',

        // HVAC (3000 - 3999)
        'TemperatureAndHumiditySensor' => 'target_temperature',
        'CO2Sensor' => '',
        'RoomThermostat' => 'target_temperature',
        'RoomThermostatWithHumiditySensor' => '',
        'BinaryInputWithTemperatureSensor' => 'target_temperature',
        'RadiatorThermostat' => 'target_temperature',
        'TemperatureSensor' => 'target_temperature',
        'HumiditySensor' => '',
        'WaterValve' => '',
        'WaterMeter' => '',
        'WeatherStation' => '',
        'NetatmoMainModule' => '',
        'NetatmoOutdoorModule' => '',
        'NetatmoIndoorModule' => '',
        'NetatmoRainModule' => '',
        'TwoChannelCosiTherm' => '',
        'SixChannelCosiTherm' => '',
        'NestThermostatWithCoolinng' => 'target_temperature',
        'NestThermostatWithHeating' => 'target_temperature',
        'NestThermostatWithHeatingAndCooling' => 'target_temperature',
        'NetatmoWindModule' => '',

        // Alarm (4000 - 4999)
        'MotionDetectorWithTemperatureBrightnessAndHumiditySensor' => '',
        'MotionDetector' => '',
        'SmokeDetector' => '',
        'FloodDetector' => '',
        'PresenceDetector' => '',
        'MotionDetectorWithTemperatureAndBrightnessSensor' => '',
        'SmokeDetectorWithTemperatureSensor' => '',
        'FloodDetectorWithTemperatureSensor' => '',
        'WatchDogDevice' => '',
        'LAG' => '',
        'OWU' => '',
        'Eurovac' => '',
        'OWWG3' => '',
        'Europress' => '',
        'MinimumDetector' => '',
        'MaximumDetector' => '',
        'SmokeDetectorAndCODetector' => '',

        // Hager (5000 - 5999)
        'InovaAlarmSystem' => '',
        'InovaDetector' => '',
        'InovaSiren' => '',
        'InovaCommand' => '',
        'InovaTransmitter' => '',
        'InovaReciever' => '',
        'InovaKoala' => '',
        'InovaInternalTransmitter' => '',
        'InovaControlPanel' => '',
        'InovaInputOutputExtension' => '',
        'InovaMotionDetectorWithVOD' => '',
        'InovaMotionDetector' => '',

        // Plants (6000 - 6999)
        'KoubachiPlantSensor' => ''
    );

    /**
     * Mapping: maps node profiles to values (defaults to 'current_value')
     */
    protected $nodes_profile_type_mapping = array(
        'None' => '',
        'Homee Cube' => '',

        // Generic (10-999)
        'OnOffPlug' => 'plug',
        'DimmableMeteringSwitch' => 'light',
        'MeteringSwitch' => 'light',
        'MeteringPlug' => 'plug',
        'DimmablePlug' => 'plug',
        'DimmableSwitch' => 'light',
        'OnOffSwitch' => 'remote',
        'DoubleOnOffSwitch' => 'remote',
        'DimmableMeteringPlug' => 'plug',
        'OneButtonRemote' => 'remote',
        'BinaryInput' => '',
        'DimmableColorMeteringSwitch' => '',
        'DoubleBinaryInput' => '',
        'TwoButtonRemote' => 'remote',
        'ThreeButtonRemote' => 'remote',
        'FourButtonRemote' => 'remote',
        'AlarmSensor' => '',

        // Lighting (1000 - 1999
        'BrightnessSensor' => '',
        'DimmableColorLight' => '',
        'DimmableExtendedColorLight' => '',
        'DimmableColorTemperatureLight' => '',

        // Closures (2000 - 2999)
        'OpenCloseSensor' => 'state',
        'WindowHandle' => 'state',
        'ShutterPositionSwitch' => 'state',
        'OpenCloseAndTemperatureSensor' => 'state',
        'ElectricMotorMeteringSwitch' => 'state',
        '??' => '',

        // HVAC (3000 - 3999)
        'TemperatureAndHumiditySensor' => '',
        'CO2Sensor' => '',
        'RoomThermostat' => 'thermostat',
        'RoomThermostatWithHumiditySensor' => '',
        'BinaryInputWithTemperatureSensor' => 'thermostat',
        'RadiatorThermostat' => 'thermostat',
        'TemperatureSensor' => 'thermostat',
        'HumiditySensor' => '',
        'WaterValve' => '',
        'WaterMeter' => '',
        'WeatherStation' => '',
        'NetatmoMainModule' => '',
        'NetatmoOutdoorModule' => '',
        'NetatmoIndoorModule' => '',
        'NetatmoRainModule' => '',
        'TwoChannelCosiTherm' => '',
        'SixChannelCosiTherm' => '',
        'NestThermostatWithCoolinng' => 'thermostat',
        'NestThermostatWithHeating' => 'thermostat',
        'NestThermostatWithHeatingAndCooling' => 'thermostat',
        'NetatmoWindModule' => '',

        // Alarm (4000 - 4999)
        'MotionDetectorWithTemperatureBrightnessAndHumiditySensor' => '',
        'MotionDetector' => '',
        'SmokeDetector' => '',
        'FloodDetector' => '',
        'PresenceDetector' => '',
        'MotionDetectorWithTemperatureAndBrightnessSensor' => '',
        'SmokeDetectorWithTemperatureSensor' => '',
        'FloodDetectorWithTemperatureSensor' => '',
        'WatchDogDevice' => '',
        'LAG' => '',
        'OWU' => '',
        'Eurovac' => '',
        'OWWG3' => '',
        'Europress' => '',
        'MinimumDetector' => '',
        'MaximumDetector' => '',
        'SmokeDetectorAndCODetector' => '',

        // Hager (5000 - 5999)
        'InovaAlarmSystem' => '',
        'InovaDetector' => '',
        'InovaSiren' => '',
        'InovaCommand' => '',
        'InovaTransmitter' => '',
        'InovaReciever' => '',
        'InovaKoala' => '',
        'InovaInternalTransmitter' => '',
        'InovaControlPanel' => '',
        'InovaInputOutputExtension' => '',
        'InovaMotionDetectorWithVOD' => '',
        'InovaMotionDetector' => '',

        // Plants (6000 - 6999)
        'KoubachiPlantSensor' => ''
    );



}
