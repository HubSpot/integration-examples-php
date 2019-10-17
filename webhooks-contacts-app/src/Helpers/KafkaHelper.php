<?php
namespace Helpers;

use Kafka\Consumer;
use Kafka\ConsumerConfig;
use Kafka\Producer;
use Kafka\ProducerConfig;

class KafkaHelper
{
    protected static $producer = null;
    protected static $consumer = null;

    public static function getProducer() {
        if (!static::$producer) {
            $config = ProducerConfig::getInstance();
            $config->setMetadataRefreshIntervalMs(getEnvParam('KAFKA_REFRESH_INTERVAL_MS',1000));
            $config->setMetadataBrokerList(getEnvParam('KAFKA_BROKER_LIST','kafka:9092'));
            $config->setBrokerVersion(getEnvParam('KAFKA_BROKER_VERSION','1.0.0'));
            $config->setRequiredAck(1);
            $config->setIsAsyn(false);
            $config->setProduceInterval(getEnvParam('KAFKA_PRODUCE_INTERVAL',500));
            static::$producer = new Producer();
        }
        return static::$producer;
    }

    public static function getConsumer(array $topics) {

        $config = ConsumerConfig::getInstance();
        $config->setTopics($topics);
        if (!static::$consumer) {
            $config->setMetadataRefreshIntervalMs(getEnvParam('KAFKA_REFRESH_INTERVAL_MS',1000));
            $config->setMetadataBrokerList(getEnvParam('KAFKA_BROKER_LIST','kafka:9092'));
            $config->setBrokerVersion(getEnvParam('KAFKA_BROKER_VERSION','1.0.0'));
            $config->setGroupId(getEnvParam('KAFKA_GROUP_ID', 'events'));
            static::$consumer = new Consumer();
        }
        return static::$consumer;
    }

}