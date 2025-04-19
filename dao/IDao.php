<?php

interface IDao {
    function create($obj);
    function update($obj);
    function delete($obj);
    function findById($id);
    function findAll();
}