void USART_transmitdouble(double* d)
{
    union Sharedblock
    {
        char part[4];
        double data;

    } my_block;
    my_block.data = *d;
    for(int i=0;i<4;++i)
    {
        USART_send(my_block.part[i]);
    }


}

int main()
{
    USART_init();
    double dble=5.5;
    while(1)
    {
       USART_transmitdouble(&dble);
    }
    return 0;
}

