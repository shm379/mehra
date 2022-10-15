import {
  generateRootCSSVars,
  generateTailwindColors,
} from '../../../../generators'

it('generates Tailwind colors', () => {
  expect(generateTailwindColors()).toEqual(
    expect.objectContaining({
      current: 'currentColor',
      inherit: 'inherit',
      transparent: 'transparent',
      black: '#000',
      white: '#fff',
      primary: {
        100: 'rgba(var(--colors-primary-100), <alpha-value>)',
        200: 'rgba(var(--colors-primary-200), <alpha-value>)',
        300: 'rgba(var(--colors-primary-300), <alpha-value>)',
        400: 'rgba(var(--colors-primary-400), <alpha-value>)',
        50: 'rgba(var(--colors-primary-50), <alpha-value>)',
        500: 'rgba(var(--colors-primary-500), <alpha-value>)',
        600: 'rgba(var(--colors-primary-600), <alpha-value>)',
        700: 'rgba(var(--colors-primary-700), <alpha-value>)',
        800: 'rgba(var(--colors-primary-800), <alpha-value>)',
        900: 'rgba(var(--colors-primary-900), <alpha-value>)',
      },
    })
  )
})

const data = {
  lightBlue: {
    100: 'rgba(var(--colors-lightBlue-100), <alpha-value>)',
    200: 'rgba(var(--colors-lightBlue-200), <alpha-value>)',
    300: 'rgba(var(--colors-lightBlue-300), <alpha-value>)',
    400: 'rgba(var(--colors-lightBlue-400), <alpha-value>)',
    50: 'rgba(var(--colors-lightBlue-50), <alpha-value>)',
    500: 'rgba(var(--colors-lightBlue-500), <alpha-value>)',
    600: 'rgba(var(--colors-lightBlue-600), <alpha-value>)',
    700: 'rgba(var(--colors-lightBlue-700), <alpha-value>)',
    800: 'rgba(var(--colors-lightBlue-800), <alpha-value>)',
    900: 'rgba(var(--colors-lightBlue-900), <alpha-value>)',
  },

  warmGray: {
    100: 'rgba(var(--colors-warmGray-100), <alpha-value>)',
    200: 'rgba(var(--colors-warmGray-200), <alpha-value>)',
    300: 'rgba(var(--colors-warmGray-300), <alpha-value>)',
    400: 'rgba(var(--colors-warmGray-400), <alpha-value>)',
    50: 'rgba(var(--colors-warmGray-50), <alpha-value>)',
    500: 'rgba(var(--colors-warmGray-500), <alpha-value>)',
    600: 'rgba(var(--colors-warmGray-600), <alpha-value>)',
    700: 'rgba(var(--colors-warmGray-700), <alpha-value>)',
    800: 'rgba(var(--colors-warmGray-800), <alpha-value>)',
    900: 'rgba(var(--colors-warmGray-900), <alpha-value>)',
  },

  trueGray: {
    100: 'rgba(var(--colors-trueGray-100), <alpha-value>)',
    200: 'rgba(var(--colors-trueGray-200), <alpha-value>)',
    300: 'rgba(var(--colors-trueGray-300), <alpha-value>)',
    400: 'rgba(var(--colors-trueGray-400), <alpha-value>)',
    50: 'rgba(var(--colors-trueGray-50), <alpha-value>)',
    500: 'rgba(var(--colors-trueGray-500), <alpha-value>)',
    600: 'rgba(var(--colors-trueGray-600), <alpha-value>)',
    700: 'rgba(var(--colors-trueGray-700), <alpha-value>)',
    800: 'rgba(var(--colors-trueGray-800), <alpha-value>)',
    900: 'rgba(var(--colors-trueGray-900), <alpha-value>)',
  },

  coolGray: {
    100: 'rgba(var(--colors-coolGray-100), <alpha-value>)',
    200: 'rgba(var(--colors-coolGray-200), <alpha-value>)',
    300: 'rgba(var(--colors-coolGray-300), <alpha-value>)',
    400: 'rgba(var(--colors-coolGray-400), <alpha-value>)',
    50: 'rgba(var(--colors-coolGray-50), <alpha-value>)',
    500: 'rgba(var(--colors-coolGray-500), <alpha-value>)',
    600: 'rgba(var(--colors-coolGray-600), <alpha-value>)',
    700: 'rgba(var(--colors-coolGray-700), <alpha-value>)',
    800: 'rgba(var(--colors-coolGray-800), <alpha-value>)',
    900: 'rgba(var(--colors-coolGray-900), <alpha-value>)',
  },

  blueGray: {
    100: 'rgba(var(--colors-blueGray-100), <alpha-value>)',
    200: 'rgba(var(--colors-blueGray-200), <alpha-value>)',
    300: 'rgba(var(--colors-blueGray-300), <alpha-value>)',
    400: 'rgba(var(--colors-blueGray-400), <alpha-value>)',
    50: 'rgba(var(--colors-blueGray-50), <alpha-value>)',
    500: 'rgba(var(--colors-blueGray-500), <alpha-value>)',
    600: 'rgba(var(--colors-blueGray-600), <alpha-value>)',
    700: 'rgba(var(--colors-blueGray-700), <alpha-value>)',
    800: 'rgba(var(--colors-blueGray-800), <alpha-value>)',
    900: 'rgba(var(--colors-blueGray-900), <alpha-value>)',
  },
}

describe.each(Object.keys(data))(
  `It does not generate the deprecated Tailwind colors`,
  key => {
    it(`does not generate "${key}" colors`, () => {
      expect(generateTailwindColors()).toEqual(
        expect.not.objectContaining({ [key]: data[key] })
      )
    })
  }
)

it('generates root CSS variables', () => {
  expect(generateRootCSSVars()).toEqual(
    expect.objectContaining({
      '--colors-primary-50': '240, 249, 255',
      '--colors-primary-100': '224, 242, 254',
      '--colors-primary-200': '186, 230, 253',
      '--colors-primary-300': '125, 211, 252',
      '--colors-primary-400': '56, 189, 248',
      '--colors-primary-500': '14, 165, 233',
      '--colors-primary-600': '2, 132, 199',
      '--colors-primary-700': '3, 105, 161',
      '--colors-primary-800': '7, 89, 133',
      '--colors-primary-900': '12, 74, 110',
    })
  )

  expect(generateRootCSSVars()).toEqual(
    expect.not.objectContaining({
      '--colors-inherit': 'inherit',
      '--colors-current': 'current',
      '--colors-transparent': 'transparent',
    })
  )
})
