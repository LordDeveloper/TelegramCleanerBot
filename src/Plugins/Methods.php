<?php


namespace Jey\Plugins;

use Jey\Exception\BadRequestException;

trait Methods
{

    /**
     * @param $args
     * @return mixed
     * @throws BadRequestException
     */
    public function deleteMessage(
        $args)
    {
        if(!isset($args['chat_id'])) throw new BadRequestException('`chat_id` parameter can not be empty.');
        if(!isset($args['id']) || !is_array($args['id'])) throw new BadRequestException('`id` parameter have been type of array.');
        $promise = $this-> multiRequest();
        foreach($args['id'] as $id)
            $promise -> addPost('chat_id', $args['chat_id'])
                -> addParam('message_id', $id)
                -> addHandle('deleteMessage');

        $promise-> execute()
                -> close();
        return $promise -> getResponse();
    }

    /**
     * @param $args
     * @return mixed
     * @throws BadRequestException
     */
    public function sendMessage(
        $args)
    {
        if(!isset($args['chat_id'])) throw new BadRequestException('`chat_id` parameter is required.');
        if(!isset($args['text']) || !is_string($args['text'])) throw new BadRequestException('`text` parameter have been type of string.');
        $promise = $this-> request('sendMessage');
        $promise-> addPost('chat_id', $args['chat_id'])
                -> addPost('text', $args['text'])
                -> execute()
                -> close();
        return $promise-> getResponse();

    }
    /**
     * @param $args
     * @return mixed
     * @throws BadRequestException
     */
    public function editMessageText(
        $args)
    {
        if(!isset($args['chat_id'])) throw new BadRequestException('`chat_id` parameter is required.');
        if(!isset($args['message_id'])) throw new BadRequestException('`message_id` parameter is required.');
        if(!isset($args['text']) || !is_string($args['text'])) throw new BadRequestException('`text` parameter have been type of string.');
        $promise = $this-> request('editMessageText');
        $promise-> addPost('chat_id', $args['chat_id'])
                -> addPost('text', $args['text'])
                -> addPost('message_id', $args['message_id'])
                -> execute()
                -> close();
        return $promise-> getResponse();

    }

    /**
     * @param $args
     * @return mixed
     * @throws BadRequestException
     */
    public function getChatMember(
        $args)
    {
        if(!isset($args['chat_id'])) throw new BadRequestException('`chat_id` parameter is required.');
        if(!isset($args['user_id'])) throw new BadRequestException('`user_id` parameter is required.');
        $promise = $this-> request('getChatMember');
        $promise-> addPost('chat_id', $args['chat_id'])
            -> addPost('user_id', $args['user_id'])
            -> execute()
            -> close();
        return $promise-> getResponse();
    }
}