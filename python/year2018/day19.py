from math import sqrt

def divisors(num):
    div = set()
    max = sqrt(num) + 1
    i = 1
    while (i < max):
        if (num % i == 0):
            div.add(i)
            div.add(num / i)
        i += 1
    return div

def run_instructions(a=0):
    d = 930
    if a:
        d = 10551330
        a = 0

    f = 1
    while (d >= f):
        b = 1
        while d >= b:
            if (f * b == d):
                a += f
            b += 1
        f += 1

    return a

print run_instructions()
print sum(divisors(10551330))
